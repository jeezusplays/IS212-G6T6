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
    public function run(): void
    {
        DB::table('staff_skill')->insert([
            // Skill id and proficiency id is left empty for now 
            ['staff_id' => 1, 'skill_id' => '', 'proficiency_id' => ''],
            ['staff_id' => 2, 'skill_id' => '', 'proficiency_id' => ''],
            ['staff_id' => 3, 'skill_id' => '', 'proficiency_id' => ''],
            ['staff_id' => 4, 'skill_id' => '', 'proficiency_id' => ''],
            ['staff_id' => 5, 'skill_id' => '', 'proficiency_id' => ''],
            ['staff_id' => 5, 'skill_id' => '', 'proficiency_id' => ''],
        ]);
    }
}
