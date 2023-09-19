<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessRightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('access_rights')->insert([
            ['access_name' => 'Admin'],
            ['access_name' => 'HR'],
            ['access_name' => 'Staff'],
            // Add more access rights here
        ]);
    }
}
