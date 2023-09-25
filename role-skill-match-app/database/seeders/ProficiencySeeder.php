<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Proficiency;

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
