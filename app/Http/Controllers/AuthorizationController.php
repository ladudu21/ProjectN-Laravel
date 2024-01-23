<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthorizationController extends Controller
{
    public function assignPermissonForm() {
        return view('admin.authorizations.permission', [
            'roles' => Role::all()
        ]);
    }

    public function assignPermisson(Request $request) {
        $permissions =  array_map('intval', $request->input('list_check'));

        $role = Role::find($request->role);

        $role->syncPermissions($permissions);

        return back()->with('message', 'Success!');
    }

    public function getAllPermissions(Request $request) {
        $permissions = Permission::all();

        $role = Role::find($request->role);

        $check = $role->permissions->pluck('id');

        return response()->json([
            'permissions' => $permissions,
            'check' => $check
        ]);
    }

    public function assignRoleForm() {
        return view('admin.authorizations.role', [
            'roles' => Role::all(),
            'users' => Admin::all()
        ]);
    }

    public function assignRole(Request $request) {
        $validated = $request->validate([
            'role' => 'required',
            'user' => 'required'
        ]);
        $user = Admin::find($validated['user']);

        $user->syncRoles($validated['role']);

        return back()->with('message', 'Success!');
    }
}
