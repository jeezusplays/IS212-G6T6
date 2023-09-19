<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            [
                'role' => 'Software Engineer',
                'description' => 'Develop software applications.',
                'department_id' => 1, // TODO: Check 
                'country_id' => 1, // TODO: Check 
                'work_arrangement' => 'Full-time',
                'vacancy' => 3,
                'status' => 'Open',
                'deadline' => '2023-10-31', 
                'creation_date' => '2023-09-17', // TODO: Check 
                'created_by' => 1,
            ],
            [
                'role' => 'Graphic Designer',
                'description' => 'Create visual designs for marketing materials.',
                'department_id' => 2, // TODO: Check 
                'country_id' => 2, // TODO: Check 
                'work_arrangement' => 'Part-time',
                'vacancy' => 2,
                'status' => 'Open',
                'deadline' => '2023-10-15',
                'creation_date' => '2023-09-17', // TODO: Check 
                'created_by' => 1,
            ],
            // Add more roles here
        ]);
    }
}
