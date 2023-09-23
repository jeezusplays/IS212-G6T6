<?php

namespace App\Http\Controllers;

use Illuminate\Http\CreateRoleRequest;

use App\Models\Role;

class RoleController extends Controller
{
    public function store(CreateRoleRequest $request): RedirectResponse
    {
        // Retrieve the validated input data...
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
