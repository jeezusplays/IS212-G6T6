<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
Use App\Models\Role_Listing;
Use App\Models\Role;
Use App\Models\Hiring_Manager;
Use App\Models\Staff;
Use App\Models\Application;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    
    public static $lastId = 0;

    public function create()
    {
        $roleId = self::$lastId + 1;
        return view('/create-role', ['Role_ID' => $roleId]);  
    }
    
    public function store(Request $request)
    {

        // Save mutliselect forms as arrays

        // Get all selected hiring managers as array
        // $staffIds = $request->input('Staff_ID', []);
        // Save selected options
        // Role::create([
        //     'Staff_ID' => $staffIds 
        // ]);

        // Get all selected skills as array
        // $skills = $request->input('skills', []);
        // Save selected options
        // Role::create([
        //     'skills' => $skills
        // ]);

        
        // Retrieve the validated input data...>
        @dump($request->input());
        @dump($request->only(['Role_Name', 'Department_ID', 'Country_ID', 'Work_Arrangement', 'Status']));
        @dump($request->except(['Role_Name', 'Department_ID', 'Country_ID', 'Work_Arrangement', 'Status']));

        // Check if role already exists in the database
        // $role = Role_Listing::firstOrCreate($request->only(['Role_Name', 'Department_ID', 'Country_ID', 'Work_Arrangement', 'Status']), $request->except(['Role_Name', 'Department_ID', 'Country_ID', 'Work_Arrangement', 'Status']));

    //     // Check if role was recently created or not
        // if ($role->wasRecentlyCreated) {
        //     console.log("Role was created");
        //     // Role was created, return 200 OK HTTP code
        //     return redirect('/welcome', 200);
        // } else {
        //     console.log("Role was not created");
        //     // Role already exists, return 409 Conflict HTTP code
        //     return redirect('/', 409);
        // }
    }

    function getData(Request $req)
    {
        @dump($req->input());
        return $req->input();
    }

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

            $status = $role->status === 1 ? 'Open' : 'Closed';

            return [
                'listing_id' => $role->listing_id, // listing_id
                'role_id' => $role->role_id, // role_id
                'role' => $matchingRole ? $matchingRole->role : null, // job title
                'created_at' => $role->created_at->format('Y-m-d'), // creation_date
                'full_name' => $staffRecord ? $staffRecord->full_name : null, // listed by
                'status' => $status, // status
                'total_applications' => $applicationCount ? $applicationCount->total_applications : 0, // total_applications
            ];
        });
        return view('role-listings', compact('roles'));
        return response()->json($roles);
    }

}

