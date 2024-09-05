<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Generate 20 posts
        for ($i = 1; $i <= 20; $i++) {
            DB::table('posts')->insert([
                'title' => 'Job Title ' . $i,
                'description' => 'This is the description for Job ' . $i,
                'responsibilities' => 'Responsibilities for Job ' . $i,
                'requirements' => 'Requirements for Job ' . $i,
                'benefits' => 'Benefits for Job ' . $i,
                'location' => 'Location ' . $i,
                'work_type' => ['remote', 'on_site', 'hybrid'][array_rand(['remote', 'on_site', 'hybrid'])], // Random work type
                'min_salary' => rand(3000, 5000),
                'max_salary' => rand(6000, 10000),
                'file' => null, // No file provided
                'application_deadline' => now()->addDays(rand(10, 30)), // Random future date
                'status' => ['pending', 'approved', 'rejected'][array_rand(['pending', 'approved', 'rejected'])], // Random status
                'user_id' => rand(1, 5), // Assuming there are at least 5 users in the users table
                'category_id' => rand(1, 5), // Assuming there are at least 5 categories
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
