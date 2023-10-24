<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Staff (0 Roles applied)
            // Staff_ID: 1
            // Staff_FName: Ji Eun
            // Staff_LName: Lee
            // Department_ID: 1 (Sales)
            // Country_ID: 1 (Singapore)
            // Email: hxliow.2021@scis.smu.edu.sg
            // Access_ID: 1 (User)
        Staff::create([
            'staff_id' => 1,
            'role_id' => 1,
            'staff_fname' => 'Ji Eun',
            'staff_lname' => 'Lee',
            'department_id' => 1, 
            'country_id' => 1, 
            'email' => 'hxliow.2021@scis.smu.edu.sg',
            'access_id' => 1,
        ]);
        // Staff (2 Roles applied)
            // Staff_ID: 2
            // Staff_FName: Jackson
            // Staff_LName: Wang
            // Staff_FullName: Jackson Wang
            // Department_ID: 2 (Consultancy)
            // Country_ID: 1 (Singapore)
            // Email: hxliow.2021@scis.smu.edu.sg
            // Access_ID: 1 (User)
        Staff::create([
            'staff_id' => 2,
            'role_id' => 2,
            'staff_fname' => 'Jackson',
            'staff_lname' => 'Wang',
            'department_id' => 2, 
            'country_id' => 1, 
            'email' => 'hxliow.2021@scis.smu.edu.sg',
            'access_id' => 1,
        ]);
        // Staff (5 Roles applied)
            // Staff_ID: 3
            // Staff_FName: Yoo
            // Staff_LName: Gong
            // Staff_FullName: Gong Yoo
            // Department_ID: 3 (System Solutioning)
            // Country_ID: 1 (Singapore)
            // Email:hxliow.2021@scis.smu.edu.sg
            // Access_ID: 1 (User)
        Staff::create([
            'staff_id' => 3,
            'role_id' => 3,
            'staff_fname' => 'Yoo',
            'staff_lname' => 'Gong',
            'department_id' => 3, 
            'country_id' => 1, 
            'email' => 'hxliow.2021@scis.smu.edu.sg',
            'access_id' => 1,
        ]);
        // HR ---------------------------------------------------
            // Staff_ID: 4
            // Staff_FName: Bin
            // Staff_LName: Hyun
            // Staff_FullName: Hyun Bin
            // Department_ID: 4 (Engineering)
            // Country_ID: 1 (Singapore)
            // Email:hxliow.2021@scis.smu.edu.sg
            // Access_ID: 3 (Admin)
        Staff::create([
            'staff_id' => 4,
            'role_id' => 4,
            'staff_fname' => 'Bin',
            'staff_lname' => 'Hyun',
            'department_id' => 4, 
            'country_id' => 1, 
            'email' => 'hxliow.2021@scis.smu.edu.sg',
            'access_id' => 3,
        ]);
            // Staff_ID: 5
            // Staff_FName: Bo Gum
            // Staff_LName: Park
            // Staff_FullName: Park Bo Gum
            // Department_ID: 5 (HR and Admin)
            // Country_ID: 1 (Singapore)
            // Email:hxliow.2021@scis.smu.edu.sg
            // Access_ID: 3 (Admin)
        Staff::create([
            'staff_id' => 5,
            'role_id' => 5,
            'staff_fname' => 'Bo Gum',
            'staff_lname' => 'Park',
            'department_id' => 5, 
            'country_id' => 1, 
            'email' => 'hxliow.2021@scis.smu.edu.sg',
            'access_id' => 3,
        ]);
        // Manager ---------------------------------------------------
            // Staff_ID: 6
            // Staff_FName: Sejeong
            // Staff_LName: Kim
            // Staff_FullName: Kim Sejeong
            // Department_ID: 6 (Finance)
            // Country_ID: 1 (Singapore)
            // Email:hxliow.2021@scis.smu.edu.sg
            // Access_ID: 2 (Manager)
        Staff::create([
            'staff_id' => 6,
            'role_id' => 1,
            'staff_fname' => 'Sejeong',
            'staff_lname' => 'Kim',
            'department_id' => 6, 
            'country_id' => 1, 
            'email' => 'hxliow.2021@scis.smu.edu.sg',
            'access_id' => 2,
        ]);
        Staff::create([
            'staff_id' => 7,
            'role_id' => 3,
            'staff_fname' => 'Na Eun',
            'staff_lname' => 'Son',
            'department_id' => 4, 
            'country_id' => 4, 
            'email' => 'hxliow.2021@scis.smu.edu.sg',
            'access_id' => 2,
        ]);
        Staff::create([
            'staff_id' => 8,
            'role_id' => 5,
            'staff_fname' => 'Sohee',
            'staff_lname' => 'Han',
            'department_id' => 2, 
            'country_id' => 3, 
            'email' => 'hxliow.2021@scis.smu.edu.sg',
            'access_id' => 4,
        ]);
    }
}
