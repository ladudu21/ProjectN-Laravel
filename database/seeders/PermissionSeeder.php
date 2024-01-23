<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['guard_name' => 'admin', 'name' => 'add post'],
            ['guard_name' => 'admin', 'name' => 'edit post'],
            ['guard_name' => 'admin', 'name' => 'delete post'],

            ['guard_name' => 'admin', 'name' => 'add category'],
            ['guard_name' => 'admin', 'name' => 'edit category'],
            ['guard_name' => 'admin', 'name' => 'delete category'],

            ['guard_name' => 'admin', 'name' => 'add user'],
            ['guard_name' => 'admin', 'name' => 'edit user'],
            ['guard_name' => 'admin', 'name' => 'delete user'],

            ['guard_name' => 'admin', 'name' => 'add noti'],
            ['guard_name' => 'admin', 'name' => 'edit noti'],
            ['guard_name' => 'admin', 'name' => 'delete noti'],

            ['guard_name' => 'admin', 'name' => 'assign per'],
            ['guard_name' => 'admin', 'name' => 'assign role'],
        ]);
    }
}
