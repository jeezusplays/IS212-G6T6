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
                'is_selected' => false,
                'date_applied' => '2023-09-17', // TODO: Check
                'role_id' => 1, // TODO: Check
                'staff_id' => 1, // TODO: Check
            ],
            [
                'is_selected' => true,
                'date_applied' => '2023-09-18', // TODO: Check
                'role_id' => 2, // TODO: Check
                'staff_id' => 2, // TODO: Check
            ],
            // Add more application entries here
        ]);
    }
}
