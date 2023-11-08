<?php

namespace Database\Seeders;

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
            ['staff_id' => 1, 'skill_id' => 1, 'proficiency_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 1, 'skill_id' => 2, 'proficiency_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 1, 'skill_id' => 7, 'proficiency_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 1, 'skill_id' => 8, 'proficiency_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 1, 'skill_id' => 5, 'proficiency_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 2, 'skill_id' => 3, 'proficiency_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 2, 'skill_id' => 4, 'proficiency_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 3, 'skill_id' => 5, 'proficiency_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 3, 'skill_id' => 6, 'proficiency_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 4, 'skill_id' => 7, 'proficiency_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 4, 'skill_id' => 8, 'proficiency_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 5, 'skill_id' => 9, 'proficiency_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 5, 'skill_id' => 10, 'proficiency_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 6, 'skill_id' => 11, 'proficiency_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 6, 'skill_id' => 12, 'proficiency_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 7, 'skill_id' => 5, 'proficiency_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 7, 'skill_id' => 6, 'proficiency_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 7, 'skill_id' => 7, 'proficiency_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 8, 'skill_id' => 9, 'proficiency_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 8, 'skill_id' => 10, 'proficiency_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 8, 'skill_id' => 16, 'proficiency_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 8, 'skill_id' => 17, 'proficiency_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 8, 'skill_id' => 18, 'proficiency_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 8, 'skill_id' => 2, 'proficiency_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => 8, 'skill_id' => 5, 'proficiency_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
