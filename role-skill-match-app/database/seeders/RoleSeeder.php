<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// import model
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'role_id' => 1,
            'role' => 'Financial Analyst',
            
        ]);
        Role::create([
            'role_id' => 2,
            'role' => 'Consultant',
            
        ]);
        Role::create([
            'role_id' => 3,
            'role' => 'Solution Architect',
            
        ]);
        Role::create([
            'role_id' => 4,
            'role' => 'Operations Manager',
            
        ]);
        Role::create([
            'role_id' => 5,
            'role' => 'Employer Branding Specialist',
            
        ]);
    }
}
