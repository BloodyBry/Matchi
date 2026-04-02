<?php

namespace Database\Seeders;

use App\Models\Sport;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Matchi',
            'phone' => '0600000000',
            'email' => 'admin@matchi.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        User::create([
            'first_name' => 'Manager',
            'last_name' => 'Matchi',
            'phone' => '0611111111',
            'email' => 'manager@matchi.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'status' => 'active',
        ]);

        User::create([
            'first_name' => 'User',
            'last_name' => 'Matchi',
            'phone' => '0622222222',
            'email' => 'user@matchi.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active',
        ]);

        Sport::create(['name' => 'Football', 'description' => 'Sport collectif']);
        Sport::create(['name' => 'Padel', 'description' => 'Sport de raquette']);
        Sport::create(['name' => 'Tennis', 'description' => 'Sport de raquette']);
        Sport::create(['name' => 'Basketball', 'description' => 'Sport collectif']);
    }
}