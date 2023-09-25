<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Role_Listing;
Use App\Models\Role;
Use App\Models\Hiring_Manager;
Use App\Models\Staff;
Use App\Models\Application;
Use App\Models\Department;
use Illuminate\Support\Facades\DB;

class UpdateRoleController extends Controller
{
    public function index()
    {
        
    }

    public function store(Request $request)
    {
        return($request->input());
    }

    public function retrieveRoleListing($passedvalue="1")
    {
        // Retrieve all role data from the database
       
        $RoleListing_Table = Role_Listing::where('role_id', $passedvalue)->get();
         


        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id','role']);
        $HiringManager_Table = Hiring_Manager::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id','staff_id']);
        $Staff_Table =  Staff::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id',DB::raw('CONCAT(staff_lname, " ", staff_fname) AS full_name')]);
        
        $Department_Table = Department::whereIn('department_id', $RoleListing_Table->pluck('department_id'))->get(['department_id','department']);
        
        $roles = $RoleListing_Table->map(function ($role) use ($Role_Table,$HiringManager_Table,$Staff_Table,$RoleListing_Table) {

        $matchingRole = $Role_Table->firstWhere('role_id', $role->role_id);
        $workArrangement = $RoleListing_Table->first()->work_arrangement;          
        $department = $Department_Table->first()->department;
        // Find the corresponding staff record using the role_id
        $staffRecord = $Staff_Table->where('role_id', $role->role_id)->first();
        $status = $role->status === 1 ? 'Open' : 'Closed';

        
            return [
                //'role_id' => $matchingRole ? $matchingRole->role_id : null,
                'role' => $matchingRole ? $matchingRole->role : null,  //job title
                'work_arrangement' => $workArrangement,
                //'department'=>$department  
                
            ];
        });

        return response()->json($roles);
    }
}
?>