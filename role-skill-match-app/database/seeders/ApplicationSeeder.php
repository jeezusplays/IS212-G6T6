<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */ 
    public function run(): void
    {
        DB::table('application')->insert([
            [
                'Application_id' => 1,
                'Status' => 1, 
                'Application_Date' => '2023-01-01',
                'Role_id' => 1, 
                'Staff_id' => 2
            ],
            [
                'Application_id' => 2,
                'Status' => 1, 
                'Application_Date' => '2023-02-02',
                'Role_id' => 2, 
                'Staff_id' => 2
            ],
            [
                'Application_id' => 3,
                'Status' => 1, 
                'Application_Date' => '2023-03-03',
                'Role_id' => 1, 
                'Staff_id' => 3
            ],
            [
                'Application_id' => 4,
                'Status' => 1, 
                'Application_Date' => '2023-04-04',
                'Role_id' => 2, 
                'Staff_id' => 3
            ],
            [
                'Application_id' => 5,
                'Status' => 1, 
                'Application_Date' => '2023-05-05',
                'Role_id' => 3, 
                'Staff_id' => 3
            ],
            [
                'Application_id' => 6,
                'Status' => 1, 
                'Application_Date' => '2023-06-06',
                'Role_id' => 4, 
                'Staff_id' => 3
            ],
            [
                'Application_id' => 7,
                'Status' => 1, 
                'Application_Date' => '2023-07-07',
                'Role_id' => 5, 
                'Staff_id' => 3
            ],
            
            // Add more application entries here

        ]);
    }
}
