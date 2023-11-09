<?php

namespace Database\Seeders;

use App\Models\Hiring_Manager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HiringManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('')->insert([
        // ]);
        // TODO: Will add in role_id when we modify the role table into 1. Full roles 2. Current Role 3. Role listings
        // currently populated with random role_id, to test inputting data into D
        Hiring_Manager::create([
            'listing_id' => 1, 'staff_id' => 6, 'created_at' => now(), 'updated_at' => now(),
        ]);
        /* Hiring_Manager::create([
            'listing_id' => 2, 'staff_id' => 6, 'created_at' => now(), 'updated_at' => now()
        ]); */
        Hiring_Manager::create([
            'listing_id' => 3, 'staff_id' => 7, 'created_at' => now(), 'updated_at' => now(),
        ]);
        Hiring_Manager::create([
            'listing_id' => 4, 'staff_id' => 7, 'created_at' => now(), 'updated_at' => now(),
        ]);
        Hiring_Manager::create([
            'listing_id' => 5, 'staff_id' => 7, 'created_at' => now(), 'updated_at' => now(),
        ]);
        Hiring_Manager::create([
            'listing_id' => 6, 'staff_id' => 6, 'created_at' => now(), 'updated_at' => now(),
        ]);

        Hiring_Manager::create([
            'listing_id' => 7, 'staff_id' => 6, 'created_at' => now(), 'updated_at' => now(),
        ]);
        Hiring_Manager::create([
            'listing_id' => 8, 'staff_id' => 6, 'created_at' => now(), 'updated_at' => now(),
        ]);
        Hiring_Manager::create([
            'listing_id' => 9, 'staff_id' => 6, 'created_at' => now(), 'updated_at' => now(),
        ]);
        Hiring_Manager::create([
            'listing_id' => 10, 'staff_id' => 7, 'created_at' => now(), 'updated_at' => now(),
        ]);
        Hiring_Manager::create([
            'listing_id' => 11, 'staff_id' => 7, 'created_at' => now(), 'updated_at' => now(),
        ]);
        Hiring_Manager::create([
            'listing_id' => 12, 'staff_id' => 7, 'created_at' => now(), 'updated_at' => now(),
        ]);
    }
}
