<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '555-0100',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Samantha Client',
            'email' => 'samantha@example.com',
            'phone' => '555-0101',
            'role' => 'client',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Mark Client',
            'email' => 'mark@example.com',
            'phone' => '555-0102',
            'role' => 'client',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Lisa Client',
            'email' => 'lisa@example.com',
            'phone' => '555-0103',
            'role' => 'client',
            'password' => Hash::make('password'),
        ]);
    }
}
