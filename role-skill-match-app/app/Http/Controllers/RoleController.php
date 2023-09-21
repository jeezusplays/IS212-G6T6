<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
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
                'Work_Arrangement'=> 'Full-time',
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
                'Work_Arrangement'=> 'Full-time',
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
