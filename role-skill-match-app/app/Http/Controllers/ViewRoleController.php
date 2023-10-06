<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Department;
use App\Models\Hiring_Manager;
use App\Models\Role;
use App\Models\Role_Listing;
use App\Models\Role_Skill;
use App\Models\Skill;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ViewRoleController extends Controller
{
    public function index()
    {
        return view('view-role');
    }

    public function getListing($passedlisting)
    { 
        // Retrieve all role data from the database
        $RoleListing_Table = Role_Listing::where('listing_id', $passedlisting)->get();
        //declaring tables
        $HiringManager_Table = Hiring_Manager::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))->get(['listing_id', 'staff_id']);

        $Department_Table = Department::whereIn('department_id', $RoleListing_Table->pluck('department_id'))->get(['department_id', 'department']);

        $Country_Table = Country::whereIn('country_id', $RoleListing_Table->pluck('country_id'))->get(['country_id', 'country']);

        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id', 'role']);
        //$RoleSkill_Table = Role_Skill::where('listing_id', $passedlisting)->get(['listing_id','skill_id']);
        $RoleSkill_Table = Role_Skill::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))->get(['listing_id', 'skill_id']);

        $Skill_Table = Skill::join('role_skill', 'skill.skill_id', '=', 'role_skill.skill_id')
            ->join('role_listing', function ($join) use ($passedlisting) {
                $join->on('role_skill.listing_id', '=', 'role_listing.listing_id')
                    ->where('role_listing.listing_id', '=', $passedlisting);
            })
            ->select('skill.skill')
            ->get();

        $roles = $RoleListing_Table->map(function ($role) use ($Skill_Table, $Role_Table, $RoleListing_Table, $Department_Table, $passedlisting, $Country_Table) {
            $staffNames = [];
            $matchingRole = $Role_Table->firstWhere('role_id', $role->role_id);
            $workArrangement = $RoleListing_Table->first()->work_arrangement;
            $vacancy = $RoleListing_Table->first()->vacancy;
            $deadline = $RoleListing_Table->first()->deadline;
            $department = $Department_Table->first()->department;
            $department_id = $Department_Table->first()->department_id;
            $country = $Country_Table->first()->country;
            $country_id = $Country_Table->first()->country_id;
            $description = $RoleListing_Table->first()->description;
            $skills = $Skill_Table->pluck('skill')->toArray();
            $status = $RoleListing_Table->first()->status;

            //$country_id= $RoleListing_Table->first()->country_id;

            $staffNames = DB::table('role_listing')
                ->where('hiring_manager.listing_id', $passedlisting)
                ->join('hiring_manager', 'role_listing.listing_id', '=', 'hiring_manager.listing_id')
                ->join('staff', 'hiring_manager.staff_id', '=', 'staff.staff_id')
                ->selectRaw('DISTINCT CONCAT(staff.staff_lname, " ", staff.staff_fname) as staff_name')
                ->pluck('staff_name')
                ->toArray();

            // Find the corresponding staff record using the role_id

            //$status = $role->status === 1 ? 'Open' : 'Closed';

            return [
                //'role_id' => $matchingRole ? $matchingRole->role_id : null,
                'listingID' => $passedlisting,
                'role' => $matchingRole ? $matchingRole->role : null,  //job title
                'work_arrangement' => $workArrangement, //work arrangement
                'department' => $department,   //department
                'department_id' => $department_id,
                'vacancy' => $vacancy, //vacancy
                'deadline' => $deadline, //deadline
                'staff_name' => $staffNames,
                'description' => $description,
                'skills' => $skills,
                'status' => $status,
                'country_id' => $country_id,
                'country' => $country,
                /* 'country_id' => $country_Id,
                'country' => $country, */

            ];
        });

        $roles = $roles->filter(function ($role) {
            return $role['status'] == 1;
        });

        if ($roles->isEmpty()) {
            // If no roles with status 1 are found, you can return a message or redirect
            return 'Role listing is closed';
        }

        return view('view-role', compact('roles'));
    }

}
?>