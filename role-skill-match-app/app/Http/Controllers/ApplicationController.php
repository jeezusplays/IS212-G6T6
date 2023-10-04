<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    //

    public function index()
    {
        return csrf_token();
    }

    public function store(Request $request)
    {
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
