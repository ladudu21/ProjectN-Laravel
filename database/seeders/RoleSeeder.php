<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'admin', 'guard_name' => 'admin']);

        $role1->givePermissionTo(Permission::where('guard_name', 'admin')->get());

        $role2 = Role::create(['name' => 'writer', 'guard_name' => 'admin']);

        $role2->givePermissionTo(['add post', 'edit post', 'delete post']);
    }
}
