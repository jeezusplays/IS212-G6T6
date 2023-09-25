<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */ 
    public function run(): void
    {
        Application::create([
            'Status' => 1, 
            'Application_Date' => '2023-01-01',
            'listing_id' =>1,
            'Staff_id' => 2
        ]);
        Application::create([
            'Status' => 1, 
            'Application_Date' => '2023-02-02',
            'listing_id' =>2,
            'Staff_id' => 2
        ]);
        Application::create([
            'Status' => 1, 
            'Application_Date' => '2023-03-03',
            'listing_id' =>3,
            'Staff_id' => 3
        ]);
        Application::create([
            'Status' => 1, 
            'Application_Date' => '2023-04-04',
            'listing_id' =>4, 
            'Staff_id' => 3
        ]);
        Application::create([
            'Status' => 1, 
            'Application_Date' => '2023-05-05',
            'listing_id' =>5,
            'Staff_id' => 3
        ]);
        Application::create([
            'Status' => 1, 
            'Application_Date' => '2023-06-06',
            'listing_id' =>1,
            'Staff_id' => 3
        ]);
        Application::create([
            'Status' => 1, 
            'Application_Date' => '2023-07-07',
            'listing_id' =>2,
            'Staff_id' => 3
        ]);
    
            // Add more application entries here
    }
}
