<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Role;
use App\Models\Role_Listing;
use App\Models\Role_Skill;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrowseAllRoleController extends Controller
{
    protected $ExpiredDeadlineController;

    public function __construct(ExpiredDeadlineController $ExpiredDeadlineController)
    {
        $this->ExpiredDeadlineController = $ExpiredDeadlineController;
    }

    public function index_view(Request $request)
    {
        // update status for expired role listings
        $this->ExpiredDeadlineController->updateStatusForExpiredDeadlines();
        // Retrieve all role listing data
        $RoleListing_Table = Role_Listing::all();

        // Retrieve all role data where the role_id is in the Role_Listing table
        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id', 'role']);

        // Retrieve all application data where the listing_id is in the Role_Listing table
        $Application_Table = Application::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))
            ->selectRaw('listing_id, COUNT(application_id) as total_applications')
            ->groupBy('listing_id')
            ->get();

        // Retrieve all department data where department_id is in the Role_Listing table
        $Department_Table = DB::table('department')
            ->join('role_listing', 'department.department_id', '=', 'role_listing.department_id')
            ->selectRaw('role_listing.department_id, department.department')
            ->get();

        // Retrieve all staff data where the role_id is in the Role_Listing table
        $Staff_Table = DB::table('staff')
            ->join('role_listing', 'staff.staff_id', '=', 'role_listing.created_by')
            ->selectRaw('role_listing.role_id, CONCAT(staff.staff_lname, " ", staff.staff_fname) AS full_name')
            ->get();

        // Retrieve all country data where country_id is in the Role_Listing table
        $Country_Table = DB::table('country')
            ->join('role_listing', 'country.country_id', '=', 'role_listing.country_id')
            ->selectRaw('role_listing.country_id, country.country')
            ->get();

        // Retrieve skill_id values for each listing_id
        $SkillIds = Role_Skill::select('listing_id', 'skill_id')->get();

        // Define arrays for departments, skills, and countries
        $departments = DB::table('department')->pluck('department')->toArray();
        $skills = DB::table('skill')->pluck('skill')->toArray();
        $countries = DB::table('country')->pluck('country')->toArray();

        // Apply filters
        $filteredRoles = $RoleListing_Table;

        if ($request->has('department_filter')) {
            $filteredRoles = $filteredRoles->whereIn('department_id', $Department_Table->pluck('department_id')->toArray());
        }

        if ($request->has('skill_filter')) {
            $filteredRoles = $filteredRoles->whereIn('listing_id', $SkillIds->whereIn('skill_id', $skills)->pluck('listing_id')->toArray());
        }

        if ($request->has('country_filter')) {
            $filteredRoles = $filteredRoles->whereIn('country_id', $Country_Table->pluck('country_id')->toArray());
        }

        // Filter based on the selected skillset
        if ($request->has('skill_filter')) {
            $selectedSkillset = $request->input('skill_filter');
            $filteredRoles = $filteredRoles->whereIn('listing_id', function ($query) use ($selectedSkillset) {
                $query->select('listing_id')
                    ->from('role_skill')
                    ->join('skill', 'role_skill.skill_id', '=', 'skill.skill_id')
                    ->where('skill.skill', $selectedSkillset);
            });
        }
        $roles = $RoleListing_Table->map(function ($role) use ($Role_Table, $Department_Table, $Staff_Table, $Application_Table, $Country_Table, $SkillIds) {

            $matchingRole = $Role_Table->firstWhere('role_id', $role->role_id);

            // Find the corresponding staff record using the role_id
            $department = $Department_Table->firstWhere('department_id', $role->department_id); // department
            $country = $Country_Table->firstWhere('country_id', $role->country_id); // country
            $staffRecord = $Staff_Table->where('role_id', $role->role_id)->first();
            $applicationCount = $Application_Table->where('listing_id', $role->listing_id)->first();
            $skillIds = $SkillIds->where('listing_id', $role->listing_id)->pluck('skill_id')->toArray(); // Find the skill_id values for the current listing_id
            $skills = DB::table('skill')->whereIn('skill_id', $skillIds)->pluck('skill')->toArray(); // Retrieve skill names from the Skills table based on the skill IDs
            $vacancy = $role->vacancy;
            $status = $role->status === 1 ? 'Open' : 'Closed';
            $work_arrangement = $role->work_arrangement === 1 ? 'Part Time' : 'Full Time';

            // Calculate current date and find out days until deadline
            $currentDate = date('Y-m-d');
            //$deadline = $role->deadline;
            $deadline = Carbon::parse($role->deadline)->format('d-m-Y');
            $diff = strtotime($deadline) - strtotime($currentDate);
            $daysUntilDeadline = round($diff / 86400);

            // Calculate current date and find out days from creation
            $currentDate = date('Y-m-d');
            $creationDate = $role->created_at->format('Y-m-d');
            $diff = strtotime($currentDate) - strtotime($creationDate);
            $daysFromCreation = round($diff / 86400);

            return [
                'listing_id' => $role->listing_id, // listing_id
                'role_id' => $role->role_id, // role_id
                'role' => $matchingRole ? $matchingRole->role : null, // job title
                'department' => $department ? $department->department : null, // department
                'country' => $country ? $country->country : null, // country
                'created_at' => $role->created_at->format('Y-m-d'), // creation_date
                'full_name' => $staffRecord ? $staffRecord->full_name : null, // listed by
                'status' => $status, // status
                'total_applications' => $applicationCount ? $applicationCount->total_applications : 0, // total_applications
                'vacancy' => $vacancy, // vacancy
                'work_arrangement' => $work_arrangement, // work_arrangement
                'skills' => $skills, // skills
                'deadline' => $deadline, // deadline
                'days_until_deadline' => $daysUntilDeadline, // days_until_deadline
                'days_from_creation' => $daysFromCreation, // days_from_creation
            ];
        });

        //return skills of current staff user
        $staff_skills = DB::table('staff_skill')
            ->join('skill', 'staff_skill.skill_id', '=', 'skill.skill_id')
            ->where('staff_skill.staff_id', '=', $request->staff_id)
            ->select('skill.skill_id', 'skill.skill')
            ->get();

        $staff_id = $request->staff_id;

        return view('browse-roles', compact('roles', 'departments', 'skills', 'countries', 'staff_skills', 'staff_id'));

        // For testing purposes only, to view the JSON data
        return response()->json($roles);
    }
}
