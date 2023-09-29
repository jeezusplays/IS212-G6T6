<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Hiring_Manager;
use App\Models\Role;
use App\Models\Role_Listing;
use App\Models\Staff;
use Illuminate\Http\Request;
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

        // Check if role already exists in the database
        $role = Role::where('role', $request->input('Role_Name'))->first();

        if (! $role) {
            // return error message
            return redirect()->back()->withErrors(['Role does not exist']);
        }

        $role_listing = Role_Listing::firstOrCreate(
            [
                'role_id' => 1,
                'description' => $request->input('Description'),
                'department_id' => $request->input('Department_ID'),
                'country_id' => $request->input('Country_ID'),
                'work_arrangement' => $request->input('Work_Arrangement'),
                'status' => $request->input('Status'),
            ],
            [
                'vacancy' => $request->input('Vacancy'),
                'deadline' => $request->input('Deadline'),
                'created_by' => $request->input('Created_By'),
            ]);

        // Check if role was recently created or not
        if ($role_listing->wasRecentlyCreated) {
            $managers = $request->input('Staff_ID');
            foreach ($managers as $manager) {
                $query = DB::table('hiring_manager')->insert(
                    [
                        'listing_id' => $role_listing->listing_id,
                        'staff_id' => $manager,
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }

            $skills = $request->input('Skills', []);
            foreach ($skills as $skill) {
                $role_skill = DB::table('role_skill')->insert(
                    [
                        'listing_id' => $role_listing->listing_id,
                        'skill_id' => $skill,
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }

            // Role was created, return 200 OK HTTP code
            return redirect('/create-role')->with('success', 'Role created successfully!');

        } else {
            // Role already exists, return 409 Conflict HTTP code
            return response()->json(
                [
                    'error' => 'Conflict, role already exists',
                    'listing_create' => $role_listing->wasRecentlyCreated,
                ], 409);
        }
    }

    public function index()
    {
        // Retrieve all role data from the database
        $RoleListing_Table = Role_Listing::all();
        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id', 'role']);
        $HiringManager_Table = Hiring_Manager::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id', 'staff_id']);
        $Staff_Table = Staff::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id', DB::raw('CONCAT(staff_lname, " ", staff_fname) AS full_name')]);
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

        $roles = $RoleListing_Table->map(function ($role) use ($Role_Table, $Staff_Table, $Application_Table) {

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

        return response()->json($roles);
    }
}
