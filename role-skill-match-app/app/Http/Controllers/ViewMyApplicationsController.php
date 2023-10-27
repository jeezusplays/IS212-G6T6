<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Role;
use App\Models\Role_Listing;
use App\Models\Role_Skill;
use App\Models\Staff;
use App\Models\Department;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ExpiredDeadlineController;

class ViewMyApplicationsController extends Controller
{
    
    public function getMyApplications($currentStaffID)
    {
        
        // Retrieve all role data from the database
        $Application_Table = Application::where('staff_id',$currentStaffID)->get();
        $RoleListing_Table = Role_Listing::whereIn('listing_id', $Application_Table->pluck('listing_id'))->get();
        
        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id', 'role']);
        $Department_Table = Department::whereIn('department_id', $RoleListing_Table->pluck('department_id'))->get(['department_id', 'department']);


        $Country_Table = Country::whereIn('country_id', $RoleListing_Table->pluck('country_id'))->get(['country_id', 'country']);
        $today = now();

        $Application_Table->each(function ($application) use ($today) {
            $application->num_days_since_application = $today->diffInDays($application->application_date);
        });
        //declaring tables
        
    
        $roles = [
            'num_days_since_application'=> $Application_Table->pluck('num_days_since_application'),
            'application_status' => $Application_Table->pluck('status'),
            'department' => $Department_Table->pluck('department'),
            'role' => $Role_Table->pluck('role'),
            'country' => $Country_Table->pluck('country')
        ];

        #insert frontend view here
        return view('view-role', compact('roles'));
    }
}
