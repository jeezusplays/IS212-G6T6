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
            ['proficiency_id' => 1, 'proficiency' => 'Beginner'],
            ['proficiency_id' => 2, 'proficiency' => 'Intermediate'],
            ['proficiency_id' => 3, 'proficiency' => 'Expert']
        ]);
    }
}
