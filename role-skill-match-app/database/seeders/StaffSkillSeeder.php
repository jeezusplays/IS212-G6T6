<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /* proficiency_id is supposed to be empty*/
    public function run(): void
    {
        DB::table('staff_skill')->insert([
            // Skill id and proficiency id is left empty for now 
            ['staff_id' => 1, 'skill_id' => 1, 'proficiency_id' => 1],
            ['staff_id' => 1, 'skill_id' => 2, 'proficiency_id' => 2],
            ['staff_id' => 2, 'skill_id' => 3, 'proficiency_id' => 3],
            ['staff_id' => 2, 'skill_id' => 4, 'proficiency_id' => 1],
            ['staff_id' => 3, 'skill_id' => 5, 'proficiency_id' => 2],
            ['staff_id' => 3, 'skill_id' => 6, 'proficiency_id' => 3],
            ['staff_id' => 4, 'skill_id' => 7, 'proficiency_id' => 1],
            ['staff_id' => 4, 'skill_id' => 8, 'proficiency_id' => 2],
            ['staff_id' => 5, 'skill_id' => 9, 'proficiency_id' => 3],
            ['staff_id' => 5, 'skill_id' => 10, 'proficiency_id' => 1],
            ['staff_id' => 6, 'skill_id' => 11, 'proficiency_id' => 2],
            ['staff_id' => 6, 'skill_id' => 12, 'proficiency_id' => 3],
        ]);
    }
}
