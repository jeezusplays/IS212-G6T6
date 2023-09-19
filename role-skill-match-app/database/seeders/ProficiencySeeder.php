<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProficiencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('proficiency')->insert([
            ['proficiency' => 'Beginner'],
            ['proficiency' => 'Intermediate'],
            ['proficiency' => 'Expert']
        ]);
    }
}
