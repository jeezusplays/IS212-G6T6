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
            'Application_Date' => '2023-07-15',
            'listing_id' =>3,
            'Staff_id' => 1
        ]);
        Application::create([
            'Status' => 2, 
            'Application_Date' => '2023-07-15',
            'listing_id' =>7,
            'Staff_id' => 1
        ]);
        Application::create([
            'Status' => 6, 
            'Application_Date' => '2023-03-15',
            'listing_id' =>6,
            'Staff_id' => 1
        ]);
        Application::create([
            'Status' => 3, 
            'Application_Date' => '2023-03-15',
            'listing_id' =>12,
            'Staff_id' => 1
        ]);
        Application::create([
            'Status' => 4, 
            'Application_Date' => '2023-03-15',
            'listing_id' =>11,
            'Staff_id' => 1
        ]);
        Application::create([
            'Status' => 5, 
            'Application_Date' => '2023-03-15',
            'listing_id' =>10,
            'Staff_id' => 1
        ]);
        ///////
        Application::create([
            'Status' => 1, 
            'Application_Date' => '2023-01-01',
            'listing_id' =>1,
            'Staff_id' => 2
        ]);
        Application::create([
            'Status' => 1, 
            'Application_Date' => '2023-01-01',
            'listing_id' =>3,
            'Staff_id' => 2
        ]);
        Application::create([
            'Status' => 2, 
            'Application_Date' => '2023-02-02',
            'listing_id' =>5,
            'Staff_id' => 2
        ]);

        //////////////////////////
        Application::create([
            'Status' => 3, 
            'Application_Date' => '2023-04-04',
            'listing_id' =>4, 
            'Staff_id' => 3
        ]);
        Application::create([
            'Status' => 5, 
            'Application_Date' => '2023-05-05',
            'listing_id' =>5,
            'Staff_id' => 3
        ]);
        Application::create([
            'Status' => 6, 
            'Application_Date' => '2023-06-06',
            'listing_id' =>1,
            'Staff_id' => 3
        ]);

    
            // Add more application entries here
        // hyunbin (admin access rights), 1 applied, 2 hr received, 1 interview scheduled
        Application::create([
            'Status' => 3, 
            'Application_Date' => '2023-08-01',
            'listing_id' =>3,
            'Staff_id' => 4
        ]);
        Application::create([
            'Status' => 2, 
            'Application_Date' => '2023-08-03',
            'listing_id' =>5,
            'Staff_id' => 4
        ]);
     

        // son na eun (manager), 2 rejected, 2 withdrawn
        Application::create([
            'Status' => 5, 
            'Application_Date' => '2022-01-01',
            'listing_id' =>1,
            'Staff_id' => 7
        ]);
        Application::create([
            'Status' => 5, 
            'Application_Date' => '2022-01-01',
            'listing_id' =>5,
            'Staff_id' => 7
        ]);
        Application::create([
            'Status' => 6, 
            'Application_Date' => '2022-01-21',
            'listing_id' =>4,
            'Staff_id' => 7
        ]);
        
        /////////////////////////////////////////////
        Application::create([
            'Status' => 1, 
            'Application_Date' => '2023-07-20',
            'listing_id' =>1,
            'Staff_id' => 5
        ]);
        Application::create([
            'Status' => 2, 
            'Application_Date' => '2023-07-20',
            'listing_id' =>2,
            'Staff_id' => 5
        ]);
        Application::create([
            'Status' => 2, 
            'Application_Date' => '2023-07-20',
            'listing_id' =>3,
            'Staff_id' => 5
        ]);
        Application::create([
            'Status' => 3, 
            'Application_Date' => '2023-07-20',
            'listing_id' =>4,
            'Staff_id' => 5
        ]);
        Application::create([
            'Status' => 3, 
            'Application_Date' => '2023-07-20',
            'listing_id' =>6,
            'Staff_id' => 5
        ]);

    }
}
