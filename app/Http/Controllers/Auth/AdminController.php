<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginForm() {
        return view('auth.admin-login');
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        }else{
            return back();
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
