<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@company.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@company.com',
            'password' => Hash::make('password123'),
        ]);
    }
}