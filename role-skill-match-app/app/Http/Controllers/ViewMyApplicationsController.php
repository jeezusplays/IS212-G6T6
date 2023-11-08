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
    
    /* public function getMyApplications($currentStaffID)
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
    
        $roles = [
            'num_days_since_application'=> $Application_Table->pluck('num_days_since_application'),
            'application_status' => $Application_Table->pluck('status'),
            'department' => $Department_Table->pluck('department'),
            'role' => $Role_Table->pluck('role'),
            'country' => $Country_Table->pluck('country')
        ]; 
        
        $departments = DB::table('department')->pluck('department')->toArray();
        $countries = DB::table('country')->pluck('country')->toArray();
        $skills = DB::table('skill')->pluck('skill')->toArray();
        #insert frontend view here
        dd($roles);
        return view('view-my-applications', compact('roles', 'departments','countries'));
    }  */
    public function getMyApplications($currentStaffID) {
        // Retrieve all role data from the database
        $Application_Table = Application::where('staff_id', $currentStaffID)->get();
        $Role_Table = Role::join('role_listing', 'role.role_id', '=', 'role_listing.role_id')
            ->whereIn('role_listing.listing_id', $Application_Table->pluck('listing_id'))
            ->get(['role.role_id', 'role.role']);
        $today = now();
        $Country_Table = Country::join('role_listing', 'country.country_id', '=', 'role_listing.country_id')
            ->whereIn('role_listing.listing_id', $Application_Table->pluck('listing_id'))
            ->get(['country.country_id', 'country.country']);
        $Department_Table = Department::join('role_listing', 'department.department_id', '=', 'role_listing.department_id')
            ->whereIn('role_listing.listing_id', $Application_Table->pluck('listing_id'))
            ->get(['department.department_id', 'department.department']);
   
        $Application_Table->each(function ($application) use ($today) {
            $application->num_days_since_application = $today->diffInDays($application->application_date);
        });
    
        $roles = [];
    
        foreach ($Application_Table as $key => $application) {
            $roles[$key] = [
                'num_days_since_application' => $application->num_days_since_application,
                'updated_at' => Carbon::parse($application->updated_at)->format('d/m/Y H:i:s'),
                'application_status' => $application->status,
                'department' => $Department_Table[$key]->department,
                'role' => $Role_Table[$key]->role,
                'country' => $Country_Table[$key]->country,
                // Add additional fields here as needed
            ];
        }
    
        // Now, you can structure your data as an array of arrays
        $roles = array_values($roles);
    
        $departments = DB::table('department')->pluck('department')->toArray();
        $countries = DB::table('country')->pluck('country')->toArray();
        $skills = DB::table('skill')->pluck('skill')->toArray();
        //  dd($roles);
        return view('view-my-applications', compact('roles', 'departments', 'countries','skills'));
    }

    
    
    
}
