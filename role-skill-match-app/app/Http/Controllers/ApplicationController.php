<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Role_Listing;
use App\Models\Staff;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplyApplication;
use Carbon\Carbon;

class ApplicationController extends Controller
{
    // request contains listing_id and staff_id from frontend only
    public function store(Request $request)
    {
        $listing_id = $request->input('listing_id');
        $staff_id = $request->input('staff_id');
        //check that role listing status is open
        $listing = Role_Listing::where('listing_id', $listing_id)->first();
        if ($listing->status != 1) {
            return redirect()->back()->with('error', 'This role is not open!');
        }

        //check that less than 5 applications exist for staff
        $existing_applications = Application::where('staff_id', $staff_id)
            ->whereIn('status', [1, 2, 3])
            ->get();
        if (count($existing_applications) >= 5) {
            return redirect()->back()->with('error', 'You have reached the maximum number of ongoing applications!');
        }

        //check that application is for role that staff does not have
        $staff_role = Staff::where('staff_id', $staff_id)->first()->role_id;
        $listing_role = Role_Listing::where('listing_id', $listing_id)->first()->role_id;
        $staff_department = Staff::where('staff_id', $staff_id)->first()->department_id;
        $listing_department = Role_Listing::where('listing_id', $listing_id)->first()->department_id;
        if ($staff_role == $listing_role && $staff_department == $listing_department) {
            return redirect()->back()->with('error', 'You already have this role in this department!');
        }

        //check that listing has more than one vacancy slot
        $listing = Role_Listing::where('listing_id', $listing_id)->first();
        if ($listing->vacancy == 0) {
            return redirect()->back()->with('error', 'This role has no vacancies!');
        }

        //check that skills for role listing match at least 1 skill for staff applying for this role
        $role_listing_skills = Role_Listing::where('listing_id', $listing_id)->first()->skills->pluck('skill_id');
        $staff_skills = DB::table('staff_skill')
            ->join('skill', 'staff_skill.skill_id', '=', 'skill.skill_id')
            ->where('staff_id', $staff_id)
            ->pluck('skill.skill_id');
        $staff_skills = $staff_skills->mapWithKeys(function ($item, $key) {
            return [$key => $item];
        });
        $matching_skills = $role_listing_skills->diff($staff_skills);
        if (count($matching_skills) == count($role_listing_skills)) {
            return redirect()->back()->with('error', 'You do not have the required skills for this role!');
        }

        //redeclare existing applications to check if there is existing application
        $existing_applications = Application::where('staff_id', $staff_id)
            ->where('listing_id', $listing_id)
            ->whereIn('status', [1, 2, 3])
            ->get();

        //check if user already has the same exisitng application
        foreach ($existing_applications as $existing_application) {
            $listing_id = $existing_application->listing_id;

            // Check if an application with the same listing_id, staff_id, and status 1, 2, or 3 exists
            $exists = Application::where('listing_id', $listing_id)
                ->where('staff_id', $staff_id)
                ->whereIn('status', [1, 2, 3])
                ->exists();

            if ($exists) {
                return redirect()->back()->with('error', 'You have already applied for this role!');
            }
        }

        $application = Application::firstOrCreate([
            'listing_id' => $listing_id,
            'staff_id' => $staff_id,
            'status' => 1,
            'application_date' => date('Y-m-d'),
        ]);

        if ($application->wasRecentlyCreated) {
            $role_name = Role::where('role_id', Role_Listing::where('listing_id', $listing_id)->first()->role_id)->first()->role;
            $work_arrangement = Role_Listing::where('listing_id', $listing_id)->first()->work_arrangement;
            $application_id = $application->application_id;
            $staff_email = Staff::where('staff_id', $staff_id)->first()->email;
            $staff_name = Staff::where('staff_id', $staff_id)->first()->staff_fname . ' ' . Staff::where('staff_id', $staff_id)->first()->staff_lname;

            // Map work_arrangement value of 1 to part time, 2 to full time
            if ($work_arrangement == 1) {
                $work_arrangement = 'Part Time';
            } else if ($work_arrangement == 2) {
                $work_arrangement = 'Full Time';
            }

            $data = [
                'role_name' => $role_name,
                'work_arrangement' => $work_arrangement,
                'staff_id' => $staff_id,
                'application_id' => $application_id,
                'application_apply_date' => Carbon::parse(now())->format('d-m-Y H:i:s'),
                'staff_email' => $staff_email,
                'staff_name' => $staff_name,
            ];

            $email = new ApplyApplication($data);
            Mail::to($staff_email)->send($email);

            return redirect()->back()->with('success', 'Application created successfully!');
        } else {
            return redirect()->back()->with('error', 'Application already exists!');
        }

    }
}
