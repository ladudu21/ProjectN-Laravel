<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function signInwithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $account = DB::table('social_logins')->where('social_id', $user->id)->first();

            if($account){

                $findUser = User::where('id', $account->user_id)->first();

                Auth::login($findUser);

                return redirect()->route('homepage');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                ]);

                DB::table('social_logins')->insert([
                    'social_id' => $user->id,
                    'social_type' => 'google',
                    'user_id' => $newUser->id
                ]);

                $newUser->assignRole('user');

                Auth::login($newUser);

                return redirect()->route('homepage');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function signInwithFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $account = DB::table('social_logins')->where('social_id', $user->id)->first();

            if($account){

                $findUser = User::where('id', $account->user_id)->first();

                Auth::login($findUser);

                return redirect('/dashboard');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                ]);

                DB::table('social_logins')->insert([
                    'social_id' => $user->id,
                    'social_type' => 'facebook',
                    'user_id' => $newUser->id
                ]);

                $newUser->assignRole('user');

                Auth::login($newUser);

                return redirect()->route('homepage');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
