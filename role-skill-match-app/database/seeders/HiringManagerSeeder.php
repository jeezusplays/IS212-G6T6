<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        DB::table('hiring_manager')->insert([
            ['role_id' => "", 'staff_id' => 6]
            // Add more permissions here
        ]);
    }
}
