<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Role_Listing;
Use App\Models\Role;
Use App\Models\Hiring_Manager;
Use App\Models\Staff;
Use App\Models\Application;
Use App\Models\Department;
Use App\Models\Role_Skill;
Use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class UpdateRoleController extends Controller
{
    public function index()
    {
        
    }

    public function store(Request $request)
    {
        return($request->input());
    }

    public function autoFillRoleListing($passedlisting=1)   //erm help me make my job easier xD, pass in role_id and listing_id here
    {
        // Retrieve all role data from the database
        $RoleListing_Table = Role_Listing::where('role_id', $passedlisting)->get(); 
        //declaring tables
        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id','role']);
        $HiringManager_Table = Hiring_Manager::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id','staff_id']);
        $Department_Table = Department::whereIn('department_id', $RoleListing_Table->pluck('department_id'))->get(['department_id','department']);
        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id','role']);
        //$RoleSkill_Table = Role_Skill::where('listing_id', $passedlisting)->get(['listing_id','skill_id']);
        $RoleSkill_Table = Role_Skill::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))->get(['listing_id','skill_id']);
          
        $Skill_Table = Skill::join('role_skill', 'skill.skill_id', '=', 'role_skill.skill_id')
            ->join('role_listing', function ($join) use ($passedlisting) {
                $join->on('role_skill.listing_id', '=', 'role_listing.listing_id')
                    ->where('role_listing.listing_id', '=', $passedlisting);
            })
            ->select('skill.skill')
            ->get();

        $roles = $RoleListing_Table->map(function ($role) use ($Skill_Table,$Role_Table,$HiringManager_Table,$RoleListing_Table,$Department_Table,$passedlisting,$RoleSkill_Table) {
        $staffNames = [];
        $matchingRole = $Role_Table->firstWhere('role_id', $role->role_id);
        $workArrangement = $RoleListing_Table->first()->work_arrangement;  
        $vacancy= $RoleListing_Table->first()->vacancy; 
        $deadline= $RoleListing_Table->first()->deadline; 
        $department = $Department_Table->first()->department;
        $description = $RoleListing_Table->first()->description; 
        $skills = $Skill_Table->pluck('skill')->toArray();
    
        $isFirstIteration = true; 
        

        $staffNames = DB::table('role_listing')
            ->where('listing_id', $passedlisting)
            ->join('hiring_manager', 'role_listing.role_id', '=', 'hiring_manager.role_id')
            ->join('staff', 'hiring_manager.staff_id', '=', 'staff.staff_id')
            ->selectRaw('DISTINCT CONCAT(staff.staff_lname, " ", staff.staff_fname) as staff_name')
            ->pluck('staff_name')
            ->toArray();
            
        
        // Find the corresponding staff record using the role_id
       
        $status = $role->status === 1 ? 'Open' : 'Closed';
        
            return [
                //'role_id' => $matchingRole ? $matchingRole->role_id : null,
                'role' => $matchingRole ? $matchingRole->role : null,  //job title
                'work_arrangement' => $workArrangement, //work arrangement
                'department'=>$department,   //department
                'vacancy' => $vacancy, //vacancy
                'deadline' => $deadline, //deadline
                'staff_name' => $staffNames,
                'description'=>$description,
                'skills'=>$skills
            ];
        });

        return response()->json($roles);
    }

    
}
?>