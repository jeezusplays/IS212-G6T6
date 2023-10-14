<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Country;
use App\Models\Department;
use App\Models\Hiring_Manager;
use App\Models\Role;
use App\Models\Role_Listing;
use App\Models\Skill;
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
        $role = Role::where('role_id', $request->input('Role_ID'))->first();

        if (! $role) {
            // return error message
            return redirect()->back()->withErrors(['Role does not exist']);
        }

        $role_listing = Role_Listing::firstOrCreate(
            [
                'role_id' => $role->role_id,
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
            ]
        );

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
                ],
                409
            );
        }
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

        

        $roles = $RoleListing_Table->map(function ($role) use ($Role_Table, $Application_Table) {

            $matchingRole = $Role_Table->firstWhere('role_id', $role->role_id);

            // Find the corresponding staff record using the role_id
            $applicationCount = $Application_Table->where('listing_id', $role->listing_id)->first();
            $vacancy = $role->vacancy;
            $status = $role->status === 1 ? 'Open' : 'Closed';
            $work_arrangement = $role->work_arrangement === 1 ? 'Part Time' : 'Full Time';
            
            $staffNames = DB::table('hiring_manager')
            ->join('staff', 'hiring_manager.staff_id', '=', 'staff.staff_id')
            ->where('hiring_manager.listing_id', $role->listing_id)
            ->selectRaw('DISTINCT CONCAT(staff.staff_lname, " ", staff.staff_fname) as staff_name')
            ->pluck('staff_name')
            ->toArray();
                
            return [
                'listing_id' => $role->listing_id, // listing_id
                'role_id' => $role->role_id, // role_id
                'role' => $matchingRole ? $matchingRole->role : null, // job title
                'created_at' => $role->created_at->format('Y-m-d'), // creation_date
                'full_name' => implode(', ', $staffNames), // listed by
                'status' => $status, // status
                'total_applications' => $applicationCount ? $applicationCount->total_applications : 0, // total_applications
                'vacancy' => $vacancy, // vacancy
                'work_arrangement' => $work_arrangement, // work_arrangement
            ];
        });

        return view('role-listings', compact('roles'));
        // return response()->json($roles);
    }

    public function setup()
    {
        //all roles
        $role_titles = Role::select('role_id', 'role')->get();

        // skills
        $skills = Skill::select('skill_id', 'skill')->get();

        // department
        $departments = Department::select('department_id', 'department')->get();

        // country
        $countries = Country::select('country_id', 'country')->get();

        // work arrangement
        $work_arrangements = [
            [
                'id' => 1,
                'name' => 'Part-time',
            ],
            [
                'id' => 2,
                'name' => 'Full-time',
            ],
        ];

        // hiring managers

        // only get staff who are hiring managers
        // $hiring_managers = DB::table('staff')->join('hiring_manager', 'staff.staff_id', '=', 'hiring_manager.staff_id')->select('staff.staff_id', 'staff_fname', 'staff_lname')->get();

        // get all staff
        $hiring_managers = DB::table('staff')->select('staff.staff_id', 'staff_fname', 'staff_lname')->get();

        // return in format that frontend expects / can read
        return view('create-role', [
            'header' => 'Create Role',

            // replace when role title input bar has been changed to dropdown
            'rolesDDL' => $role_titles,
            'title' => '',
            'vacancy' => 0,
            'deadline' => '',
            'skills' => $skills,
            'description' => '',
            'deptDDL' => $departments,
            'workArrangementDDL' => $work_arrangements,
            'countryID_DDL' => $countries,
            'Staff_ID' => $hiring_managers,
            'hiringManagerDDL' => $hiring_managers,
            // New role will be open by default
            'status' => 1,
            'Staff_ID' => 5,
        ]);
    }
}
