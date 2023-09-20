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
            'role_name' => 'Financial Analyst',
            'description' => 'Analyze financial data to provide financial advice.',
            'department_id' => 1,
            'country_id' => 1,
            'work_arrangement' => 1, 
            'vacancy' => 5,
            'status' => 1,
            'deadline' => '2023-12-31',
            'creation_date' => '2023-09-20',
            'created_by' => 'Park Bo Gum',
        ]);
        Role::create([
            'role_name' => 'Consultant',
            'description' => 'Lorem ipsum dolor sit amet',
            'department_id' => 2,
            'country_id' => 1,
            'work_arrangement' => 1, 
            'vacancy' => 5,
            'status' => 1,
            'deadline' => '2023-12-31',
            'creation_date' => '2023-09-20',
            'created_by' => 'Park Bo Gum',
        ]);
        Role::create([
            'role_name' => 'Solution Architect',
            'description' => 'Lorem ipsum dolor sit amet',
            'department_id' => 3,
            'country_id' => 1,
            'work_arrangement' => 2, 
            'vacancy' => 5,
            'status' => 1,
            'deadline' => '2023-12-31',
            'creation_date' => '2023-09-20',
            'created_by' => 'Park Bo Gum',
        ]);
        Role::create([
            'role_name' => 'Operations Manager',
            'description' => 'Lorem ipsum dolor sit amet',
            'department_id' => 4,
            'country_id' => 1,
            'work_arrangement' => 1, 
            'vacancy' => 5,
            'status' => 1,
            'deadline' => '2023-12-31',
            'creation_date' => '2023-09-20',
            'created_by' => 'Park Bo Gum',
        ]);
        Role::create([
            'role_name' => 'Employer Branding Specialist',
            'description' => 'Lorem ipsum dolor sit amet',
            'department_id' => 5,
            'country_id' => 1,
            'work_arrangement' => 1, 
            'vacancy' => 5,
            'status' => 1,
            'deadline' => '2023-12-31',
            'creation_date' => '2023-09-20',
            'created_by' => 'Park Bo Gum',
        ]);
    }
}
