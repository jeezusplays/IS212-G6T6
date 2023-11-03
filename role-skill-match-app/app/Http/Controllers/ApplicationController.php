<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Role_Listing;
use App\Models\Staff;
use Illuminate\Http\Request;

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
        $existing_applications = Application::where('staff_id', $staff_id)->get();
        if (count($existing_applications) >= 5) {
            return redirect()->back()->with('error', 'You have reached the maximum number of applications!');
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
        $staff_skills = Staff::where('staff_id', $staff_id)->first()->skills;
        dump($role_listing_skills);
        dump($staff_skills);
        // $matching_skills = $role_listing_skills->intersect($staff_skills);
        // if (count($matching_skills) == 0) {
        //     return redirect()->back()->with('error', 'You do not have the required skills for this role!');
        // }

        // $application = Application::firstOrCreate([
        //     'listing_id' => $listing_id,
        //     'staff_id' => $staff_id,
        //     'status' => 1,
        //     'application_date' => date('Y-m-d'),
        // ]);

        // if ($application->wasRecentlyCreated) {
        //     return back()->with('success', 'Application created successfully!');
        // } else {
        //     return back()->with('error', 'Application already exists!');
        // }
    }
}
