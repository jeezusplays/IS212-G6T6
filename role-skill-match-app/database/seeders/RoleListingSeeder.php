<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// import model
use App\Models\Role;

class RoleListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_listing')->insert([
            [
                'listing_id' => 1,
                'role_id' => 1,
                'description' => 'Analyze financial data to provide financial advice.',
                'department_id' => 1,
                'country_id' => 1,
                'work_arrangement' => 1, 
                'vacancy' => 5,
                'status' => 1,
                'deadline' => '2023-12-31',
                'creation_date' => '2023-09-20',
                'created_by' => 5,
            ],
            [
                'listing_id' => 2,
                'role_id' => 2,
                'description' => 'Lorem ipsum dolor sit amet',
                'department_id' => 2,
                'country_id' => 1,
                'work_arrangement' => 1, 
                'vacancy' => 5,
                'status' => 1,
                'deadline' => '2023-12-31',
                'creation_date' => '2023-09-20',
                'created_by' => 5,
            ],
            [
                'listing_id' => 3,
                'role_id' => 3,
                'description' => 'Lorem ipsum dolor sit amet',
                'department_id' => 3,
                'country_id' => 1,
                'work_arrangement' => 2, 
                'vacancy' => 5,
                'status' => 1,
                'deadline' => '2023-12-31',
                'creation_date' => '2023-09-20',
                'created_by' => 5,
            ],
            [
                'listing_id' => 4,
                'role_id' => 4,
                'description' => 'Lorem ipsum dolor sit amet',
                'department_id' => 4,
                'country_id' => 1,
                'work_arrangement' => 1, 
                'vacancy' => 5,
                'status' => 1,
                'deadline' => '2023-12-31',
                'creation_date' => '2023-09-20',
                'created_by' => 5,
            ],
            [
                'listing_id' => 5,
                'role_id' => 5,
                'description' => 'Lorem ipsum dolor sit amet',
                'department_id' => 5,
                'country_id' => 1,
                'work_arrangement' => 1, 
                'vacancy' => 5,
                'status' => 1,
                'deadline' => '2023-12-31',
                'creation_date' => '2023-09-20',
                'created_by' => 5,
            ]

        ]);
    }
}

   

