<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skill')->insert([
            ['skill' => 'Programming'],
            ['skill' => 'Database Management'],
            ['skill' => 'Graphic Design'],
            // Add more skills here
        ]);
    }
}
