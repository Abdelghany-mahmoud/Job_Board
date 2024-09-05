<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Software Development'],
            ['name' => 'Data Science'],
            ['name' => 'Graphic Design'],
            ['name' => 'Digital Marketing'],
            ['name' => 'Project Management'],
            ['name' => 'Customer Support'],
            ['name' => 'Sales'],
            ['name' => 'Human Resources'],
            ['name' => 'Finance'],
            ['name' => 'Legal'],
            ['name' => 'Content Writing'],
            ['name' => 'Engineering'],
            ['name' => 'Quality Assurance'],
            ['name' => 'Administrative Support'],
            ['name' => 'IT & Networking'],
            ['name' => 'Consulting'],
            ['name' => 'Education'],
            ['name' => 'Healthcare'],
            ['name' => 'Manufacturing'],
            ['name' => 'Construction'],
        ];

        // Insert categories into the database
        DB::table('categories')->insert($categories);
    }
}
