<?php

namespace App\Http\Controllers;

use App\Events\AccountCreated;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.users.ad-index', [
            'users' => Admin::paginate(10)
        ]);
    }

    public function create()
    {
        return view('admin.users.create', [
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $validated = $request->validated();

        $user = Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        AccountCreated::dispatch($user, $validated['password']);

        return back()->with('message', 'Success!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $user)
    {
        return view('admin.users.ad-edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $user)
    {
        $validated = $request->validated();

        $user->update($validated);

        return back()->with('message', 'Success!');
    }
}
