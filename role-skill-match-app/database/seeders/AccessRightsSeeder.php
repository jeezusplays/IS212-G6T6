<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// import model
use App\Models\Access_Rights;

class AccessRightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 3 access rights using model
        Access_Rights::create([
            'access_id' => 1,
            'access_name' => 'User',
        ]);
        Access_Rights::create([
            'access_id' => 2,
            'access_name' => 'Manager',
        ]);
        Access_Rights::create([
            'access_id' => 3,
            'access_name' => 'HR',
        ]);
        Access_Rights::create([
            'access_id' => 4,
            'access_name' => 'Admin',
        ]);
    }
}
