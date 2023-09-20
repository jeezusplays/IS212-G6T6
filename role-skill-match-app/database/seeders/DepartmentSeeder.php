<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 7 departments using model
        Department::create([
            'department_id' => '1',
            'department_name' => 'Sales',
        ]);
        Department::create([
            'department_id' => '2',
            'department_name' => 'Consulting',
        ]);
        Department::create([
            'department_id' => '3',
            'department_name' => 'System Solutioning',
        ]);
        Department::create([
            'department_id' => '4',
            'department_name' => 'Engineering',
        ]);
        Department::create([
            'department_id' => '5',
            'department_name' => 'HR and Admin',
        ]);
        Department::create([
            'department_id' => '6',
            'department_name' => 'Finance',
        ]);
        Department::create([
            'department_id' => '7',
            'department_name' => 'IT',
        ]);
    }
}
