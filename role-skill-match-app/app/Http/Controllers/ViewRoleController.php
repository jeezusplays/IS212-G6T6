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
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawApplication;

class ViewRoleController extends Controller
{
    public function index()
    {
        return view('view-role');
    }

    public function withdrawApplication (Request $request)
    {
        // Extract the 'data' key from the request
        $requestData = $request->input('data');
        $requestData = $request->json()->all();
        // dd($requestData);

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
                $listing_id = $data['listing_id'];
                $application_id = $data['application_id'];
                $role_name = $data['role_name'];
                $work_arrangement = $data['work_arrangement'];
                $staff_email = $data['staff_email'];
                $staff_name = $data['staff_name'];

                // Map work_arrangement value of 1 to part time, 2 to full time
                if ($work_arrangement == 1) {
                    $work_arrangement = 'Part Time';
                } else if ($work_arrangement == 2) {
                    $work_arrangement = 'Full Time';
                }
                
                // Update the database using DB::table
                DB::table('application')
                    ->where('application_id', $application_id)
                    ->where('listing_id', $listing_id)
                    ->where('staff_id', $staff_id)
                    ->update(['status' => 6, 'updated_at' => now()]);
            }
    
            // Commit the changes to the database
            DB::commit();

            $data = [
                'role_name' => $role_name,
                'work_arrangement' => $work_arrangement,
                'staff_id' => $staff_id,
                'application_id' => $application_id,
                'application_withdraw_date' => Carbon::parse(now())->format('d-m-Y H:i:s'),
                'staff_email' => $staff_email,
                'staff_name' => $staff_name,
            ];

            $email = new WithdrawApplication($data);
            Mail::to($staff_email)->send($email);

            return response()->json(['message' => 'Successfully withdrawn application'], 200);
        } catch (\Exception $e) {
            // Handle the error, for example:
            DB::rollBack(); // Rollback the transaction if an error occurs
            return response()->json(['message' => 'Error withdrawing application'], 500);
        }
    }

    public function getListing($currentStaffID,$passedlisting)
    {
        // Retrieve all role data from the database
        $RoleListing_Table = Role_Listing::where('listing_id', $passedlisting)->get();
        //declaring tables
        $Department_Table = Department::whereIn('department_id', $RoleListing_Table->pluck('department_id'))->get(['department_id', 'department']);

        $Country_Table = Country::whereIn('country_id', $RoleListing_Table->pluck('country_id'))->get(['country_id', 'country']);

        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id', 'role']);

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

        $Staff_Table = Staff::where('staff_id', '=', $currentStaffID)->get(['staff_id', 'staff_fname', 'staff_lname', 'email']);

        $roles = $RoleListing_Table->map(function ($role) use ($Staff_Table , $Application_Table, $Skill_Table, $Role_Table, $RoleListing_Table, $Department_Table, $passedlisting, $Country_Table) {
            $matchingRole = $Role_Table->firstWhere('role_id', $role->role_id);
            $workArrangement = $RoleListing_Table->first()->work_arrangement;
            $vacancy = $RoleListing_Table->first()->vacancy;
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
            $staff_name = $Staff_Table->first()->staff_fname . ' ' . $Staff_Table->first()->staff_lname;
            $staff_email = $Staff_Table->first()->email;

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
                'staff_name' => $staff_name,
                'staff_email' => $staff_email,
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

