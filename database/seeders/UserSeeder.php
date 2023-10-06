<?php

namespace Database\Seeders;

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

        $customer = \App\Models\User::create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'phone' => '081234567891',
            'password' => bcrypt('password'),
        ]);

        $customer->assignRole('customer');
    }
}
