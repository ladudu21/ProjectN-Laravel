<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
        ]);

        User::factory()
            ->count(5)
            ->create()->each(function ($user) {
                $user->assignRole('user');
            });
        ;

        User::factory()
            ->count(5)
            ->create()->each(function ($user) {
                $user->assignRole('writer');
            });
        ;
    }
}
