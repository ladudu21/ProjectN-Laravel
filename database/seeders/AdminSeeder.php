<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::create([
            'name' => 'ladudu',
            'email' => 'ladudu@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $admin->assignRole('admin');

        $writer = Admin::create([
            'name' => 'yasuo',
            'email' => 'yasuo@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $writer->assignRole('writer');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123'),
        ]);
    }
}
