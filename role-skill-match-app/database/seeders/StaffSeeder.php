<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('staff')->insert([
            // 2 HR Staff (1 Admin, 1 Normal)
            [
                'staff_fname' => 'John',
                'staff_lname' => 'Doe',
                'department_id' => 1, // TODO: Check
                'country_id' => 1, // TODO: Check
                'email' => 'johndoe@example.com',
                'access_id' => 1, // TODO: Check
            ],
            [
                'staff_fname' => 'Jane',
                'staff_lname' => 'Doe',
                'department_id' => 1, // TODO: Check
                'country_id' => 1, // TODO: Check
                'email' => 'janedoe@example.com',
                'access_id' => 2, // TODO: Check   
            ],

            // Regular Staff (Staff with 0/2/5 roles applied)
            // TODO: Add staff
        ]);
    }
}
