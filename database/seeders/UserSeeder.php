<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Ensure Hash facade is imported
use Illuminate\Support\Str; // Ensure Str is imported for remember_token

class UserSeeder extends Seeder
{
    public function run()
    {
        $roles = ['admin', 'job_seeker', 'employer'];

        // Seed 5 users
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password' . $i), // Hashed password
                'role' => $roles[array_rand($roles)], // Random role from the list
                // 'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
