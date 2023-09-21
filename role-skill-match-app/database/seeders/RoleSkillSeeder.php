<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO: Not sure if needed
        // DB::table('')->insert([
            
        // ]);
        DB::table('role_skill')->insert([
            ['role_id' => 1, 'skill_id' => 1],
            ['role_id' => 1, 'skill_id' => 2],
            ['role_id' => 2, 'skill_id' => 3],
            ['role_id' => 2, 'skill_id' => 4],
            ['role_id' => 3, 'skill_id' => 5],
            ['role_id' => 3, 'skill_id' => 6],
            ['role_id' => 4, 'skill_id' => 7],
            ['role_id' => 4, 'skill_id' => 8],
            ['role_id' => 5, 'skill_id' => 9],
            ['role_id' => 5, 'skill_id' => 10],

        ]);
    }
}
