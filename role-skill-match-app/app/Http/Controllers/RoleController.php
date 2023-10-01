<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Role_Listing;
Use App\Models\Role;
Use App\Models\Hiring_Manager;
Use App\Models\Staff;
Use App\Models\Application;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        // Retrieve all role data from the database
        $RoleListing_Table = Role_Listing::all();
        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id', 'role']);

        $Application_Table = Application::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))
            ->selectRaw('listing_id, COUNT(application_id) as total_applications')
            ->groupBy('listing_id')
            ->get();

        $Staff_Table = DB::table('staff')
            ->join('role_listing', 'staff.staff_id', '=', 'role_listing.created_by')
            ->selectRaw('role_listing.role_id, CONCAT(staff.staff_lname, " ", staff.staff_fname) AS full_name')
            ->get();

        $roles = $RoleListing_Table->map(function ($role) use ($Role_Table, $Staff_Table, $Application_Table) {

            $matchingRole = $Role_Table->firstWhere('role_id', $role->role_id);

            // Find the corresponding staff record using the role_id
            $staffRecord = $Staff_Table->where('role_id', $role->role_id)->first();
            $applicationCount = $Application_Table->where('listing_id', $role->listing_id)->first();
            $vacancy = $role->vacancy;
            $status = $role->status === 1 ? 'Open' : 'Closed';
            $work_arrangement = $role->work_arrangement === 1 ? 'Part Time' : 'Full Time';

            return [
                'listing_id' => $role->listing_id, // listing_id
                'role_id' => $role->role_id, // role_id
                'role' => $matchingRole ? $matchingRole->role : null, // job title
                'created_at' => $role->created_at->format('Y-m-d'), // creation_date
                'full_name' => $staffRecord ? $staffRecord->full_name : null, // listed by
                'status' => $status, // status
                'total_applications' => $applicationCount ? $applicationCount->total_applications : 0, // total_applications
                'vacancy' => $vacancy, // vacancy
                'work_arrangement' => $work_arrangement, // work_arrangement
            ];
        });
        return view('role-listings', compact('roles'));
        return response()->json($roles);
    }

}

