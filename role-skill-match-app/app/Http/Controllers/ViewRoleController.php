<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Department;
use App\Models\Role;
use App\Models\Role_Listing;
use App\Models\Role_Skill;
use App\Models\Skill;
use App\Models\Staff;
use App\Models\Application;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewRoleController extends Controller
{
    public function index()
    {
        return view('view-role');
    }

    public function getListing($currentStaffID,$passedlisting)
    {
        // Retrieve all role data from the database
        $RoleListing_Table = Role_Listing::where('listing_id', $passedlisting)->get();
        //declaring tables
        $Department_Table = Department::whereIn('department_id', $RoleListing_Table->pluck('department_id'))->get(['department_id', 'department']);

        $Country_Table = Country::whereIn('country_id', $RoleListing_Table->pluck('country_id'))->get(['country_id', 'country']);

        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id', 'role']);
        //$RoleSkill_Table = Role_Skill::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))->get(['listing_id', 'skill_id']);

        $Skill_Table = Skill::join('role_skill', 'skill.skill_id', '=', 'role_skill.skill_id')
            ->join('role_listing', function ($join) use ($passedlisting) {
                $join->on('role_skill.listing_id', '=', 'role_listing.listing_id')
                    ->where('role_listing.listing_id', '=', $passedlisting);
            })
            ->select('skill.skill')
            ->get();

        $Application_Table = Application::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))
            ->where('staff_id', '=', $currentStaffID)
            ->select('Status', 'application_id')
            ->get();

        $roles = $RoleListing_Table->map(function ($role) use ($Application_Table, $Skill_Table, $Role_Table, $RoleListing_Table, $Department_Table, $passedlisting, $Country_Table) {
            //$staffNames = [];
            $matchingRole = $Role_Table->firstWhere('role_id', $role->role_id);
            $workArrangement = $RoleListing_Table->first()->work_arrangement;
            $vacancy = $RoleListing_Table->first()->vacancy;
            //$deadline = $RoleListing_Table->first()->deadline;
            $deadline = Carbon::parse($RoleListing_Table->first()->deadline)->format('d-m-Y');
            $department = $Department_Table->first()->department;
            $department_id = $Department_Table->first()->department_id;
            $country = $Country_Table->first()->country;
            $country_id = $Country_Table->first()->country_id;
            $description = $RoleListing_Table->first()->description;
            $skills = $Skill_Table->pluck('skill')->toArray();
            $status = $RoleListing_Table->first()->status;
            // Check if the current staff user has applied for the role in application table, default value is 0
            $application = $Application_Table->isNotEmpty() ? $Application_Table->first()->Status : 0;
            $application_id = $Application_Table->isNotEmpty() ? $Application_Table->first()->application_id : null;

            return [
                'listingID' => $passedlisting,
                'role' => $matchingRole ? $matchingRole->role : null,  //job title
                'work_arrangement' => $workArrangement, //work arrangement
                'department' => $department,   //department
                'department_id' => $department_id,  
                'vacancy' => $vacancy, //vacancy
                'deadline' => $deadline, //deadline
                'description' => $description,
                'skills' => $skills,
                'status' => $status,
                'country_id' => $country_id,
                'country' => $country,
                'application' => $application,
                'application_id' => $application_id,
            ];
        });

        $isRoleValid = ($roles[0]['status'] != 2);
        
        if (! $isRoleValid) {
            $nullifiedRole = [];
            foreach ($roles[0] as $key => $value) {
                $nullifiedRole[$key] = null;
            }
            $roles->splice(0, 1, [$nullifiedRole]);
        }

        //return skills of current staff user
        $staff_skills = DB::table('staff_skill')
            ->join('skill', 'staff_skill.skill_id', '=', 'skill.skill_id')
            ->where('staff_skill.staff_id', '=', $currentStaffID)
            ->select('skill.skill_id', 'skill.skill')
            ->get();

        // return json_encode(compact('roles', 'isRoleValid', 'staff_skills'));
        return view('view-role', compact('roles', 'isRoleValid', 'staff_skills'));
    }
}

