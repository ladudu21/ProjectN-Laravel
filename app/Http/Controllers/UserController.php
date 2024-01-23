<?php

namespace App\Http\Controllers;

use App\Events\AccountCreated;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.usr-index', [
            'users' => User::paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update($validated);

        return back()->with('message', 'Success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->forceDelete();
        return back()->with('message', 'Deleted');
    }

    function getUsersByRole(Request $request) {
        if ($request->role == "user") $users = User::all();
        else $users = Admin::role($request->role)->get();

        return response()->json([
            'users' => $users
        ]);
    }
}
