<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Role_Listing;
use App\Models\Staff;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    //

    public function store(Request $request)
    {
        //check that application is for role that staff does not have
        $staff_role = Staff::where('staff_id', $request->staff_id)->first()->role_id;
        if ($staff_role == $request->role_id) {
            return redirect()->back()->with('error', 'You already have this role!');
        }

        //check that listing has more than one vacancy slot
        $listing = Role_Listing::where('listing_id', $request->listing_id)->first();
        if ($listing->vacancy == 0) {
            return redirect()->back()->with('error', 'This role has no vacancies!');
        }

        //check that less than 5 applications exist for staff
        $existing_applications = Application::where('staff_id', $request->staff_id)->get();
        if (count($existing_applications) >= 5) {
            return redirect()->back()->with('error', 'You have reached the maximum number of applications!');
        }

        $application = Application::firstOrCreate([
            'listing_id' => $request->listing_id,
            'staff_id' => $request->staff_id,
            'status' => $request->status,
            'application_date' => $request->application_date,
        ]);

        if ($application->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Application created successfully!');
        } else {
            return redirect()->back()->with('error', 'Application already exists!');
        }
    }
}
