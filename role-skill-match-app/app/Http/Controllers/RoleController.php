<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Models\Role;

class RoleController extends Controller
{
    public function store(CreateRoleRequest $request): RedirectResponse
    {
        
        // Save mutliselect forms as arrays

        // Get all selected hiring managers as array
        $staffIds = $request->input('Staff_ID', []);
        // Save selected options
        Role::create([
            'Staff_ID' => $staffIds 
        ]);

        // Get all selected skills as array
        $skills = $request->input('skills', []);
        // Save selected options
        Role::create([
            'skills' => $skills
        ]);
        
        // Retrieve the validated input data...>
        @dump($request->input());
        $data = $request->validated();

        // Check if role already exists in the database
        $role = Role::firstOrCreate($data->safe()->only(['Role_Name', 'Department_ID', 'Country_ID', 'Work_Arrangement', 'Status']), $data->safe()->except(['Role_Name', 'Department_ID', 'Country_ID', 'Work_Arrangement', 'Status']));

        // Check if role was recently created or not
        if ($role->wasRecentlyCreated) {
            // Role was created, return 200 OK HTTP code
            return redirect('/home', 200);
        } else {
            // Role already exists, return 409 Conflict HTTP code
            return redirect('/home', 409);
        }
    }

    function getData(Request $req)
    {
        @dump($req->input());
        return $req->input();
    }

    public function index()
    {
        // Retrieve role data from the database (you will need to implement this)
        // Placeholder data for roles
        $roles = [
            [
                'Role_ID' => 1,
                'Role_Name' => 'Sales Manager',
                'Description' => 'Manage sales team',
                'Department_ID' => 1, // Sales
                'Country_ID'=> 1, //Singapore
                'Work_Arrangement'=> 1, // Full-time
                'Vacancy'=> 5,
                'Status'=> 1 , //Open
                'Deadline'=> '31/12/2023',
                'Creation_Date'=> '20/9/2023',
                'Created_By'=> 'Park Bo Gum',
                'Skills' => [
                    'Python',
                    'Excel',
                    'Management'
                ],
            ],

            [
                'Role_ID' => 2,
                'Role_Name' => 'Consultant',
                'Description' => 'Provide consultation to clients',
                'Department_ID' => 2, // Consultation
                'Country_ID'=> 1, //Singapore
                'Work_Arrangement'=> 1, // Fll-time
                'Vacancy'=> 5,
                'Status'=> 1 , //Open
                'Deadline'=> '31/12/2023',
                'Creation_Date'=> '20/9/2023',
                'Created_By'=> 'Park Bo Gum',
                'Skills' => [
                    'Python',
                    'Excel',
                    'Management'
                ],
            ],
        ];
        

        return view('role-listings', compact('roles'));
    }
}
