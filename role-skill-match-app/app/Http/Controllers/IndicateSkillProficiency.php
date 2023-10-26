<?php


namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Staff_Skill;
use App\Models\Skill;
use App\Models\Proficiency;
use Illuminate\Http\RedirectResponse;
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
        // Extract the 'data' key from the request
        $requestData = $request->input('data');
    
        // Check if the 'data' key is an array, if not, convert it to an array
        if (!is_array($requestData)) {
            $requestData = [$requestData];
        }
    
        // Update the staff_skill table with the new proficiency ID using proficiency_id_new_value and updated_at timestamp
        DB::beginTransaction();
    
        try {
            foreach ($requestData as $data) {
                // Check if 'staff_id' exists in the data, if not, continue to the next iteration
                if (!isset($data['staff_id'])) {
                    continue;
                }
    
                $staff_id = $data['staff_id'];
                $skill_id = $data['skill_id'];
                $proficiency_id_new_value = $data['proficiency_id_new_value'];
    
                // Update the database using DB::table
                DB::table('staff_skill')
                    ->where('staff_id', $staff_id)
                    ->where('skill_id', $skill_id)
                    ->update(['proficiency_id' => $proficiency_id_new_value, 'updated_at' => now()]);
            }
    
            // Commit the changes to the database
            DB::commit();
    
            return response()->json(['message' => 'Successfully updated skill proficiency'], 200);
        } catch (\Exception $e) {
            // Handle the error, for example:
            DB::rollBack(); // Rollback the transaction if an error occurs
            return response()->json(['message' => 'Error updating skill proficiency'], 500);
        }
    }
    
    
    
    public function autoFillSkills($passedlisting)
    {
        // Retrieve all staff, staff_skill, skill, proficiency table data
        $staff_table = Staff::where('staff_id', $passedlisting)->get();
        $staff_skill_table = Staff_Skill::where('staff_id', $passedlisting)->get();
        $skill_table = Skill::all();

        $staff_skillset_proficiency = $staff_table->map(function ($staff) use ($staff_skill_table, $skill_table, $passedlisting) {
            $staff_name = $staff->staff_lname . " " . $staff->staff_fname;
            // Join staff_skill table with staff table
            $staff_skill_table = DB::table('staff_skill')
                ->join('staff', 'staff.staff_id', '=', 'staff_skill.staff_id')
                ->select('staff_skill.skill_id', 'staff_skill.proficiency_id')
                ->where('staff.staff_id', '=', $passedlisting)
                ->get();

            // Display skill name instead of skill id, using skill_id from Staff_Skill to map with skill_id from Skill table
            $staff_skill_table = $staff_skill_table->map(function ($staff_skill) use ($skill_table) {
                $skill_name = $skill_table->where('skill_id', $staff_skill->skill_id)->first()->skill;
                return [
                    'skill_id' => $staff_skill->skill_id,
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

        // return response()->json($staff_skillset_proficiency);
        return view('/indicate-skill-proficiency', compact('staff_skillset_proficiency'));
    }
}