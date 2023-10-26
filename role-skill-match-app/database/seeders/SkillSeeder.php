<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::create([
            'skill_id' => 1,
            'skill' => 'Capital Management',
        ]);
        Skill::create([
            'skill_id' => 2,
            'skill' => 'Capital Expenditure and Investment Evaluation',
        ]);
        Skill::create([
            'skill_id' => 3,
            'skill' => 'People Management',
        ]);
        Skill::create([
            'skill_id' => 4,
            'skill' => 'Stakeholder Management',
        ]);
        Skill::create([
            'skill_id' => 5,
            'skill' => 'Strategy Implementation',
        ]);
        Skill::create([
            'skill_id' => 6,
            'skill' => 'Architecture Design',
        ]);
        Skill::create([
            'skill_id' => 7,
            'skill' => 'Equipment Maintenance and Housekeeping',
        ]);
        Skill::create([
            'skill_id' => 8,
            'skill' => 'Project Risk Management',
        ]);
        Skill::create([
            'skill_id' => 9,
            'skill' => 'Employer Branding',
        ]);
        Skill::create([
            'skill_id' => 10,
            'skill' => 'Operational Excellence',
        ]);
        Skill::create([
            'skill_id' => 11,
            'skill' => 'Market Profiling',
        ]);
        Skill::create([
            'skill_id' => 12,
            'skill' => 'Financial Reporting',
        ]);
        Skill::create([
            'skill_id' => 13,
            'skill' => 'Cyber Security',
        ]);
        Skill::create([
            'skill_id' => 14,
            'skill' => 'Agile Software Development',
        ]);
        Skill::create([
            'skill_id' => 15,
            'skill' => 'Staff Management',
        ]);
        Skill::create([
            'skill_id' => 16,
            'skill' => 'Creative Development',
        ]);
        Skill::create([
            'skill_id' => 17,
            'skill' => 'Empathy and Emotional Intelligence',
        ]);
        Skill::create([
            'skill_id' => 18,
            'skill' => 'Story Telling',
        ]);
            // Add more skills here
    }
}