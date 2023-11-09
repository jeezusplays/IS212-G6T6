<?php

namespace Database\Seeders;

use App\Models\Proficiency;
use Illuminate\Database\Seeder;

class ProficiencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proficiency::create(['proficiency_id' => 1, 'proficiency' => 'Beginner']);
        Proficiency::create(['proficiency_id' => 2, 'proficiency' => 'Intermediate']);
        Proficiency::create(['proficiency_id' => 3, 'proficiency' => 'Expert']);
    }
}
