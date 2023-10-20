<?php


namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Staff_Skill;
use App\Models\Skill;
use App\Models\Proficiency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class IndicateSkillProficiency extends Controller
{
    public function index()
    {
        return view('/indicate-skill-proficiency');
    }
    public function store(Request $request)
    {
        $requestData = $request->input();
        $skills = $requestData['skills'];
        $proficiencies = $requestData['proficiencies'];
        $staff_id = $requestData['staff_id'];
        $staff = Staff::find($staff_id);
        $staff->skills()->detach();
        foreach ($skills as $key => $skill) {
            $staff->skills()->attach($skill, ['proficiency_id' => $proficiencies[$key]]);
        }
        return redirect('/indicate-skill-proficiency');
    }
    public function autoFillSkills($passedlisting)
    {
        // Retrieve all staff, staff_skill, skill, proficiency table data
        $staff_table = Staff::where('staff_id', $passedlisting)->get();
        $staff_skill_table = Staff_Skill::where('staff_id', $passedlisting)->get();
        $skill_table = Skill::all();
        $proficiency_table = Proficiency::all();

        $staff_skillset_proficiency = $staff_table->map(function ($staff) use ($staff_skill_table, $skill_table, $proficiency_table, $passedlisting) {
            $staff_name = [];
            $staff_name = $staff->staff_fname;
            // Join staff_skill table with staff table
            $staff_skill_table = DB::table('staff_skill')
                ->join('staff', 'staff.staff_id', '=', 'staff_skill.staff_id')
                ->select('staff_skill.skill_id', 'staff_skill.proficiency_id')
                ->where('staff.staff_id', '=', $passedlisting)
                ->get();

            // Display skill name instead of skill id, using skill_id from Staff_Skill to map with skill_id from Skill table
            $staff_skill_table = $staff_skill_table->map(function ($staff_skill) use ($skill_table) {
                $skill_name = [];
                $skill_name = $skill_table->where('skill_id', $staff_skill->skill_id)->first()->skill;
                return [
                    'skill_name' => $skill_name,
                    'proficiency_id' => $staff_skill->proficiency_id
                ];
            });

            return [
                'staff_id' => $passedlisting,
                'staff_name' => $staff_name,
                'staff_skills' => $staff_skill_table,
            ];

        });

        return response()->json($staff_skillset_proficiency);
        return view('/indicate-skill-proficiency', compact('staff_skillset_proficiency'));
    }
}
