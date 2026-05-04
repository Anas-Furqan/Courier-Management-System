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
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'phone' => '0300000000',
            'city' => 'Karachi',
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Agent User',
            'email' => 'agent@example.com',
            'password' => bcrypt('password'),
            'phone' => '0300000001',
            'city' => 'Lahore',
            'role' => 'agent',
        ]);

        \App\Models\User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
            'phone' => '0300000002',
            'city' => 'Islamabad',
            'role' => 'customer',
        ]);
    }
}
