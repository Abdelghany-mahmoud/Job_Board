<?php

use Illuminate\Database\Seeder;
use App\Models\Employer;
use App\Models\User;

class EmployerSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('role', 'employer')->first();

        Employer::create([
            'user_id' => $user->id,
            'company_name' => 'company.',
            'company_website' => 'https://company.com',
        ]);
    }
}
