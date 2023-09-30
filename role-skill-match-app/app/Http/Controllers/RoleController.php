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
        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id','role']);
        $HiringManager_Table = Hiring_Manager::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id','staff_id']);
        $Staff_Table =  Staff::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id',DB::raw('CONCAT(staff_lname, " ", staff_fname) AS full_name')]);
        //$Application_Table = Application::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))->get(['listing_id','staff_id']); 

        $Application_Table = Application::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))
        ->selectRaw('listing_id, COUNT(application_id) as total_applications')
        ->groupBy('listing_id')
        ->get();

        // Map the database records to the desired format
        /*$roles = [
            [
                'job_title' => 'Software Developer',
                'total_applications' => 50,
                'creation_date' => '2023-09-12',
                'listed_by' => 'John Doe',
                'status' => 'Open',
            ],
            [
                'job_title' => 'UX Designer',
                'total_applications' => 30,
                'creation_date' => '2023-09-14',
                'listed_by' => 'Jane Smith',
                'status' => 'Closed',
            ],
        ];*/
        
        $roles = $RoleListing_Table->map(function ($role) use ($Role_Table,$HiringManager_Table,$Staff_Table,$Application_Table) {

        $matchingRole = $Role_Table->firstWhere('role_id', $role->role_id);

        // Find the corresponding staff record using the role_id
        $staffRecord = $Staff_Table->where('role_id', $role->role_id)->first();
        $applicationCount = $Application_Table->where('listing_id', $role->listing_id)->first();

        $status = $role->status === 1 ? 'Open' : 'Closed';
            return [
                //'role_id' => $matchingRole ? $matchingRole->role_id : null,
                'role' => $matchingRole ? $matchingRole->role : null,  //job title
                'created_at' => $role->created_at->format('Y-m-d'),  //creation_date
                'full_name' => $staffRecord ? $staffRecord->full_name : null, //listed by                    
                'status' => $status,
                'total_applications' => $applicationCount ? $applicationCount->total_applications : 0, // total_applications
            ];
        });
        return view('role-listings', compact('roles'));
        return response()->json($roles);
    }

}

