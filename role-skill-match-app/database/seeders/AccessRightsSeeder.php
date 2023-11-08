<?php

namespace Database\Seeders;

use App\Models\Access_Rights;
// import model
use Illuminate\Database\Seeder;

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
