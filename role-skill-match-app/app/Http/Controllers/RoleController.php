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
            // [
            //     'Role ID' => 1,
            //     'Role Name' => 'Sales Manager',
            //     'Description' => 'Manage sales team',
            //     'Department_ID' => 1,
            //     'Country_ID' => 1,
            //     'Work_Arrangement' => 'Full Time',
            //     'Vacancy' => 5,
            //     'Status' => 1,
            //     'Deadline' => '2021-09-12',
            //     'Creation_Date' => '2021-09-12',
            //     'Created_By' => 'John Doe',
            //     'Skills' => [
            //         'Python',
            //         'Excel',
            //         'Management'
            //     ]
            // ],

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
            [
                'job_title' => 'Data Analyst',
                'total_applications' => 20,
                'creation_date' => '2023-09-15',
                'listed_by' => 'Alice Johnson',
                'status' => 'Open',
            ],
            [
                'job_title' => 'Project Manager',
                'total_applications' => 40,
                'creation_date' => '2023-09-16',
                'listed_by' => 'Bob Wilson',
                'status' => 'Open',
            ],
            [
                'job_title' => 'Graphic Designer',
                'total_applications' => 25,
                'creation_date' => '2023-09-18',
                'listed_by' => 'Eva Brown',
                'status' => 'Closed',
            ],
        ];
        
        $roles = collect($roles)->sortByDesc('creation_date')->values()->all();

        return view('role-listings', compact('roles'));
    }
}
