<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 7 departments using model
        Department::create([
            'department_id' => 1,
            'department' => 'Sales',
        ]);
        Department::create([
            'department_id' => 2,
            'department' => 'Consulting',
        ]);
        Department::create([
            'department_id' => 3,
            'department' => 'System Solutioning',
        ]);
        Department::create([
            'department_id' => 4,
            'department' => 'Engineering',
        ]);
        Department::create([
            'department_id' => 5,
            'department' => 'HR and Admin',
        ]);
        Department::create([
            'department_id' => 6,
            'department' => 'Finance',
        ]);
        Department::create([
            'department_id' => 7,
            'department' => 'IT',
        ]);
    }
}
