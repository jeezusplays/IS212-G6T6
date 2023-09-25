<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role_Listing;
use App\Models\Role;
use App\Models\Hiring_Manager;
use App\Models\Staff;
use App\Models\Application;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {

    }

    public function retrieveAll()
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

            $status = $role->status === 1 ? 'Open' : 'Closed';

            return [
                'role' => $matchingRole ? $matchingRole->role : null, // job title
                'created_at' => $role->created_at->format('Y-m-d'), // creation_date
                'full_name' => $staffRecord ? $staffRecord->full_name : null, // listed by
                'status' => $status, // status
                'total_applications' => $applicationCount ? $applicationCount->total_applications : 0, // total_applications
            ];
        });

        return response()->json($roles);
    }
}