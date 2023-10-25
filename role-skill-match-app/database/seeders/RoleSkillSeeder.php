<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role_Skill;

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
            ['listing_id' => 1, 'skill_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 1, 'skill_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 2, 'skill_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 2, 'skill_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 3, 'skill_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 3, 'skill_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 3, 'skill_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 4, 'skill_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 4, 'skill_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 4, 'skill_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 5, 'skill_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 5, 'skill_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 5, 'skill_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 5, 'skill_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 5, 'skill_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 6, 'skill_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 6, 'skill_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 6, 'skill_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 6, 'skill_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['listing_id' => 6, 'skill_id' => 10, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
    

}