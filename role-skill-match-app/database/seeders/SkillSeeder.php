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
            ['skill_id' => 1, 'skill' => 'Capital Management'],
            ['skill_id' => 2, 'skill' => 'Capital Expenditure and Investment Evaluation'],
            ['skill_id' => 3, 'skill' => 'People Management'],
            ['skill_id' => 4, 'skill' => 'Stakeholder Management'],
            ['skill_id' => 5, 'skill' => 'Strategy Implementation'],
            ['skill_id' => 6, 'skill' => 'Architecture Design'],
            ['skill_id' => 7, 'skill' => 'Equipment Maintenance and Housekeeping'],
            ['skill_id' => 8, 'skill' => 'Project Risk Management'],
            ['skill_id' => 9, 'skill' => 'Employer Branding'],
            ['skill_id' => 10, 'skill' => 'Operational Excellence'],
            ['skill_id' => 11, 'skill' => 'Market Profiling'],
            ['skill_id' => 12, 'skill' => 'Financial Reporting'],
            ['skill_id' => 13, 'skill' => 'Cyber Security'],
            ['skill_id' => 14, 'skill' => 'Agile Software Development'],
            // Add more skills here
        ]);
    }
}
