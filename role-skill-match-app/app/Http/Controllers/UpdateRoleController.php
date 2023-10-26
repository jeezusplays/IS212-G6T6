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

/*
$request = new Request();
            // Set the input data
            $request->merge([
                '_token' => 'IgfOyMbAdJXvrQGRkagnbpex41WrY8h7ZR3S1Kzu',
                'listing_id' => '3',
                'jobTitle' => 'UpdatedTitle',
                'workArrangement' => '1',
                'department' => '3',
                'hiringManager' => ['Kim Sejeong'],
                'vacancy' => '5',
                'deadline' => '2023-12-31',
                'description' => 'Lorem ipsum dolor sit amet'
            ]);
*/

class UpdateRoleController extends Controller
{
    public function index()
    {
    }

    public function store(Request $request)
    {
        
        $requestData = $request->input();
    
        $listingId = $requestData['listingID'];
        $jobTitle = $requestData['roleTitle'];
        $workArrangement = $requestData['workArrangement'];
        $department = $requestData['department'];
        $vacancy = $requestData['vacancy'];
        $deadline = $requestData['deadline'];
        $description = $requestData['description'];
        $country_id = $requestData['Country_ID'];
        $status = $requestData['Status'];


        //if passed in value is not array, assign it array, even if its 1 value
        if (! is_array($requestData['skills'])) {
            $requestData['skills'] = [$requestData['skills']];
        }

        $skills = $requestData['skills'];
        
        // Retrieve existing records for the given listingId
        $existingRecords = DB::table('role_skill')
            ->where('listing_id', $listingId)
            ->whereNull('deleted_at')
            ->get();

        //The skill ids that are currently in the role_skill table.
        $existingSkillIds = $existingRecords->pluck('skill_id')->toArray();

        // Identify missing skill IDs between passed in $skills and $existingSkillIds in database
        $missingSkills = array_diff($skills, $existingSkillIds);

        // Insert new records for the missing skill IDs
        foreach ($missingSkills as $missingSkill) {
            DB::table('role_skill')
                ->updateOrInsert(
                    ['listing_id' => $listingId, 'skill_id' => $missingSkill],
                    ['deleted_at' => null, 'created_at' => now(), 'updated_at' => now()]
                );
        }

        // Soft delete skill IDs that exist in the database, are not in $skills array, and have a null deleted_at column
        $softDeleteSkills = array_diff($existingSkillIds, $skills);

        DB::table('role_skill')
            ->where('listing_id', $listingId)
            ->whereIn('skill_id', $softDeleteSkills)
            ->update(['deleted_at' => now()]);

        // Commit the changes to the database
        DB::commit();

        ///////////////////////////////////////////////////////////////////

        //if passed in value is not array, assign it array/////////////////////////////////////////////////////////////////////
        if (! is_array($requestData['hiringManager'])) {
            $requestData['hiringManager'] = [$requestData['hiringManager']];
        }

        $hiringManagers = $requestData['hiringManager'];
        ///////////////HIRING MANAGER/////////////////////////////////////////////////////////////////////////////////////////////
        $existingRecords = DB::table('hiring_manager')
            ->where('listing_id', $listingId)
            ->whereNull('deleted_at')
            ->get();

        $existingStaffIds = $existingRecords->pluck('staff_id')->toArray();

        // Identify missing staff IDs
        $missingStaffIds = array_diff($hiringManagers, $existingStaffIds);

        // Insert new records for the missing staff IDs
        foreach ($missingStaffIds as $missingStaffId) {
            DB::table('hiring_manager')
                ->updateOrInsert(
                    ['listing_id' => $listingId, 'staff_id' => $missingStaffId],
                    ['deleted_at' => null, 'created_at' => now(), 'updated_at' => now()]
                );
        }

        // Soft delete staff IDs that exist in the database, are not in $hiringmanagers array, and have a null deleted_at column
        $softDeleteStaffIds = array_diff($existingStaffIds, $hiringManagers);

        DB::table('hiring_manager')
            ->where('listing_id', $listingId)
            ->whereIn('staff_id', $softDeleteStaffIds)
            ->update(['deleted_at' => now()]);

        // Commit the changes to the database
        DB::commit();

        ///////////////////////////////////////////////////////////END OF HIRING MANAGER///////////////////////////////

        // Check if job title exists, get role_id
        $role = DB::table('role')
            ->where('role_id', $jobTitle)
            ->first();

        if (! $role) {
            // Return view to the user current page on error, back to the form
            // return redirect()->back()->withErrors(['Job title does not exist']);
            return response()->json(['error' => 'Job title does not exist'], 400);
        }

        // Get department_id
        $dept = DB::table('department')
            ->where('department_id', $department)
            ->value('department_id');

        if (! $dept) {
            // Return view to the user current page on error, back to the form
            // return redirect()->back()->withErrors(['Department does not exist']);
            return response()->json(['error' => 'Department does not exist'], 400);
        }

        // Insert it back with soft delete
        $roleId = $role ? $role->role_id : null;

        Role_Listing::updateOrInsert(
            ['Listing_ID' => $listingId],
            [
                'Role_ID' => $roleId,
                'Description' => $description,
                'Department_ID' => $dept,
                'Country_ID' => $country_id,
                'Work_Arrangement' => $workArrangement,
                'Vacancy' => $vacancy,
                'Status' => $status,
                'Deadline' => $deadline,
                'deleted_at' => null, // Set the deleted_at column to null for soft delete
            ]
        );
        // Return view to the user current page on success, back to the form
        
        return redirect()->back()->with('success', 'Role updated successfully');
        
       
        //return response()->json(['message' => 'Fields updated successfully']);
    }

    public function autoFillRoleListing($staffid,$passedlisting)
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
                ->whereNull('hiring_manager.deleted_at') // Add this condition
                ->selectRaw('DISTINCT CONCAT(staff.staff_fname, " ", staff.staff_lname) as staff_name')
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

        $departments = $this->retrieveAllDepartments();
        $hiringManagers = $this->retrieveAllHiringManagers();
        $skills = $this->retrieveAllSkills();
        $countries = $this->retrieveAllCountries();
        $rolesDDL = $this->retrieveAllRoles();

        return view('update-role', compact('roles', 'rolesDDL', 'departments', 'hiringManagers', 'skills', 'countries'));

        return response()->json($roles);
    }

    public function retrieveAllDepartments()
    {
        $departments = Department::all(['department_id', 'department']);

        return $departments;
        // return response()->json($departments);
    }

    public function retrieveAllHiringManagers()
    {
        $hiringManagers = Staff::whereIn('staff_id', function ($query) {
            $query->select('staff_id')
                ->from('Hiring_Manager');
        })
            ->selectRaw("staff_id, CONCAT(staff_fname, ' ', staff_lname) as hiring_manager_name")
            ->get();

        return $hiringManagers;
    }

    public function retrieveAllSkills()
    {
        $skills = Skill::all(['skill_id', 'skill']);

        return $skills;
        //return view ('updateRole', compact('skills'));

    }

    public function retrieveAllCountries()
    {
        $country = Country::all(['country_id', 'country']);

        return $country;

    }
    public function retrieveAllRoles()
    {
        $role = Role::all(['role_id', 'role']);

        return $role;

    }
}
