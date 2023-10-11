<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '081234567890',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');

        // create user by factory and assign role as customer
        \App\Models\User::factory()
            ->count(20)
            ->create()
            ->each(function ($user) {
                $user->assignRole('customer');
            });
    }
}
