<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Hiring_Manager;

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
        DB::table('hiring_manager')->insert([
            ['role_id' => 1, 'staff_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            // Add more permissions here
        ]);
    }
}
