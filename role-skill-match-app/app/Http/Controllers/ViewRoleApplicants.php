<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Application;
use App\Models\Department;
use App\Models\Hiring_Manager;
use App\Models\Role;
use App\Models\Role_Listing;
use App\Models\Role_Skill;
use App\Models\Skill;
use App\Models\Staff;
use App\Models\Staff_Skill;
use App\Models\Proficiency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class ViewRoleApplicants extends Controller
{
    public function index()
    {
        return view('view-role-applicants');
    }
    public function getApplicantListing($currentStaffID,$passedlisting)
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
            //$deadline = $RoleListing_Table->first()->deadline;
            $deadline = Carbon::parse($RoleListing_Table->first()->deadline)->format('d-m-Y');
            $department = $Department_Table->first()->department;
            $department_id = $Department_Table->first()->department_id;
            $country = $Country_Table->first()->country;
            $country_id = $Country_Table->first()->country_id;
            $description = $RoleListing_Table->first()->description;
            $skills = $Skill_Table->pluck('skill')->toArray();
            $status = $RoleListing_Table->first()->status;

            $Application_Table = Application::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))
            ->selectRaw('listing_id, COUNT(application_id) as total_applications')
            ->groupBy('listing_id')
            ->get();

            $applicationCount = $Application_Table->where('listing_id', $role->listing_id)->first();

            $AllApplicant_Table = Application::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))->get(['listing_id', 'staff_id', 'application_date', 'status']);
            $Staff_Table = Staff::whereIn('staff_id', $AllApplicant_Table->pluck('staff_id'))->get(['staff_id', 'staff_fname', 'staff_lname', 'email']);
            $StaffSkill_Table = Staff_Skill::whereIn('staff_id', $Staff_Table->pluck('staff_id'))->get(['staff_id', 'skill_id']);
            $applicants = $AllApplicant_Table->map(function ($applicant) use ($StaffSkill_Table, $Staff_Table, $passedlisting) {
                // Fetch applicants, containing their name, application date, skillset, status, email  
                // Fetch staff name in staff table using staff_id from $applicants staff_id
                $staff = $Staff_Table->firstWhere('staff_id', $applicant->staff_id);
                // Fetch email in staff table using staff_id from $applicants staff_id
                $email = $staff->email;
                // Fetch status of the application in application table
                $status = $applicant->status;
                // Fetch skillset of the applicant in Skill table
                $Skill_Table_v2 = Skill::join('staff_skill', 'skill.skill_id', '=', 'staff_skill.skill_id')
                    ->join('staff', function ($join) use ($applicant) {
                        $join->on('staff_skill.staff_id', '=', 'staff.staff_id')
                            ->where('staff.staff_id', '=', $applicant->staff_id);
                    })
                    ->select('skill.skill')
                    ->get();
                $person_skills = $Skill_Table_v2->pluck('skill')->toArray();
                // Fetch proficiency of the applicant in Proficiency table
                $Proficiency_Table = Proficiency::join('staff_skill', 'proficiency.proficiency_id', '=', 'staff_skill.proficiency_id')
                    ->join('staff', function ($join) use ($applicant) {
                        $join->on('staff_skill.staff_id', '=', 'staff.staff_id')
                            ->where('staff.staff_id', '=', $applicant->staff_id);
                    })
                    ->select('proficiency.proficiency')
                    ->get();

                return [
                    'staff_id' => $applicant->staff_id, //main DONE
                    'staff_name' => $staff->staff_fname . ' ' . $staff->staff_lname, //ext DONE
                    // parse the application date via Carbon to d-m-Y format
                    'application_date' => Carbon::parse($applicant->application_date)->format('d-m-Y'), //ext DONE
                    'skillset' => $person_skills, //ext DONE
                    'proficiency' => $Proficiency_Table->pluck('proficiency')->toArray(), //ext DONE
                    'status' => $applicant->status, //ext DONE
                    'email' => $email, //ext DONE
                ];
            });
            
            //$country_id= $RoleListing_Table->first()->country_id;

            // $staffNames = DB::table('role_listing')
            //     ->where('hiring_manager.listing_id', $passedlisting)
            //     ->join('hiring_manager', 'role_listing.listing_id', '=', 'hiring_manager.listing_id')
            //     ->join('staff', 'hiring_manager.staff_id', '=', 'staff.staff_id')
            //     ->selectRaw('DISTINCT CONCAT(staff.staff_fname, " ", staff.staff_lname) as staff_name')
            //     ->pluck('staff_name')
            //     ->toArray();

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
                // 'staff_name' => $staffNames,
                'description' => $description,
                'skills' => $skills,
                'status' => $status,
                'country_id' => $country_id,
                'country' => $country,
                'applicants' => $applicants,
                'total_applications' => $applicationCount ? $applicationCount->total_applications : 0, // total_applications
            ];
        });

        /* $roles = $roles->filter(function ($role) {
            return $role['status'] == 1;
        }); */
        $isRoleValid = ($roles[0]['status'] != 2);
        

        if (!$isRoleValid) {
            $nullifiedRole = [];
            foreach ($roles[0] as $key => $value) {
                $nullifiedRole[$key] = null;
            }
            $roles->splice(0, 1, [$nullifiedRole]);
        }
        // return json_decode($roles);
        return view('view-role-applicants', compact('roles', 'isRoleValid'));
    }
}
?>