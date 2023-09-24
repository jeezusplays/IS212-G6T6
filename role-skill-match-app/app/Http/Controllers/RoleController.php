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
                'Role ID' => 1,
                'Role Name' => 'Sales Manager',
                'Description' => 'Manage sales team',
                'Department_ID' => 1,
                'Country_ID' => 1,
                'Work_Arrangement' => 'Full Time',
                'Vacancy' => 5,
                'Status' => 1,
                'Deadline' => '2021-09-12',
                'Creation_Date' => '2021-09-12',
                'Created_By' => 'John Doe',
                'Skills' => [
                    'Python',
                    'Excel',
                    'Management'
                ],
                'Total_Applications' => 9000
            ],
            [
                'Role ID' => 2,
                'Role Name' => 'Web Developer',
                'Description' => 'Design and develop web applications',
                'Department_ID' => 2,
                'Country_ID' => 3,
                'Work_Arrangement' => 'Full Time',
                'Vacancy' => 3,
                'Status' => 1,
                'Deadline' => '2021-09-14',
                'Creation_Date' => '2021-09-13',
                'Created_By' => 'Jane Smith',
                'Skills' => [
                    'HTML',
                    'CSS',
                    'JavaScript'
                ],
                'Total_Applications' => 6
            ],
            [
                'Role ID' => 3,
                'Role Name' => 'Marketing Specialist',
                'Description' => 'Plan and execute marketing campaigns',
                'Department_ID' => 3,
                'Country_ID' => 2,
                'Work_Arrangement' => 'Part Time',
                'Vacancy' => 2,
                'Status' => 0,
                'Deadline' => '2021-09-15',
                'Creation_Date' => '2021-09-14',
                'Created_By' => 'Robert Davis',
                'Skills' => [
                    'Marketing Strategy',
                    'Social Media',
                    'Content Creation'
                ],
                'Total_Applications' => 0,
            ],
            [
                'Role ID' => 4,
                'Role Name' => 'Data Analyst',
                'Description' => 'Analyze and interpret data',
                'Department_ID' => 1,
                'Country_ID' => 4,
                'Work_Arrangement' => 'Full Time',
                'Vacancy' => 4,
                'Status' => 1,
                'Deadline' => '2021-09-16',
                'Creation_Date' => '2021-09-15',
                'Created_By' => 'Alice Johnson',
                'Skills' => [
                    'Data Analysis',
                    'SQL',
                    'Data Visualization'
                ],
                'Total_Applications' => 1,
            ],
            [
                'Role ID' => 5,
                'Role Name' => 'Project Manager',
                'Description' => 'Manage project teams',
                'Department_ID' => 2,
                'Country_ID' => 1,
                'Work_Arrangement' => 'Full Time',
                'Vacancy' => 3,
                'Status' => 1,
                'Deadline' => '2021-09-18',
                'Creation_Date' => '2021-09-16',
                'Created_By' => 'Bob Wilson',
                'Skills' => [
                    'Project Management',
                    'Team Leadership',
                    'Risk Assessment'
                ],
                'Total_Applications' => 3,
            ],
            [
                'Role ID' => 6,
                'Role Name' => 'Graphic Designer',
                'Description' => 'Create visual content',
                'Department_ID' => 3,
                'Country_ID' => 2,
                'Work_Arrangement' => 'Part Time',
                'Vacancy' => 2,
                'Status' => 0,
                'Deadline' => '2021-09-19',
                'Creation_Date' => '2021-09-18',
                'Created_By' => 'Eva Brown',
                'Skills' => [
                    'Graphic Design',
                    'Adobe Creative Suite',
                    'Illustration'
                ],
                'Total_Applications' => 2
            ],
            [
                'Role ID' => 7,
                'Role Name' => 'Financial Analyst',
                'Description' => 'Analyze financial data',
                'Department_ID' => 1,
                'Country_ID' => 3,
                'Work_Arrangement' => 'Full Time',
                'Vacancy' => 5,
                'Status' => 1,
                'Deadline' => '2021-09-22',
                'Creation_Date' => '2021-09-20',
                'Created_By' => 'Chris Evans',
                'Skills' => [
                    'Financial Analysis',
                    'Excel',
                    'Financial Modeling'
                ],
                'Total_Applications' => 4,
            ],
            [
                'Role ID' => 8,
                'Role Name' => 'HR Specialist',
                'Description' => 'Manage human resources functions',
                'Department_ID' => 4,
                'Country_ID' => 1,
                'Work_Arrangement' => 'Full Time',
                'Vacancy' => 4,
                'Status' => 1,
                'Deadline' => '2021-09-24',
                'Creation_Date' => '2021-09-23',
                'Created_By' => 'Helen Turner',
                'Skills' => [
                    'HR Management',
                    'Recruitment',
                    'Employee Relations'
                ],
                'Total_Applications' => 5,
            ],
            [
                'Role ID' => 9,
                'Role Name' => 'Customer Support Specialist',
                'Description' => 'Provide customer support',
                'Department_ID' => 5,
                'Country_ID' => 4,
                'Work_Arrangement' => 'Full Time',
                'Vacancy' => 3,
                'Status' => 1,
                'Deadline' => '2021-09-26',
                'Creation_Date' => '2021-09-25',
                'Created_By' => 'Grace Harris',
                'Skills' => [
                    'Customer Service',
                    'Communication',
                    'Problem Solving'
                ],
                'Total_Applications' => 10,
            ],
            [
                'Role ID' => 10,
                'Role Name' => 'Network Engineer',
                'Description' => 'Design and maintain network infrastructure',
                'Department_ID' => 2,
                'Country_ID' => 2,
                'Work_Arrangement' => 'Full Time',
                'Vacancy' => 2,
                'Status' => 1,
                'Deadline' => '2021-09-28',
                'Creation_Date' => '2021-09-27',
                'Created_By' => 'Ian Miller',
                'Skills' => [
                    'Network Configuration',
                    'Cisco',
                    'Security'
                ],
                'Total_Applications' => 23
            ]
            
            // [
            //     'job_title' => 'Software Developer',
            //     'total_applications' => 50,
            //     'creation_date' => '2023-09-12',
            //     'listed_by' => 'John Doe',
            //     'status' => 'Open',
            // ],
            // [
            //     'job_title' => 'UX Designer',
            //     'total_applications' => 30,
            //     'creation_date' => '2023-09-14',
            //     'listed_by' => 'Jane Smith',
            //     'status' => 'Closed',
            // ],
            // [
            //     'job_title' => 'Data Analyst',
            //     'total_applications' => 20,
            //     'creation_date' => '2023-09-15',
            //     'listed_by' => 'Alice Johnson',
            //     'status' => 'Open',
            // ],
            // [
            //     'job_title' => 'Project Manager',
            //     'total_applications' => 40,
            //     'creation_date' => '2023-09-16',
            //     'listed_by' => 'Bob Wilson',
            //     'status' => 'Open',
            // ],
            // [
            //     'job_title' => 'Graphic Designer',
            //     'total_applications' => 25,
            //     'creation_date' => '2023-09-18',
            //     'listed_by' => 'Eva Brown',
            //     'status' => 'Closed',
            // ],
        ];
        
        $roles = collect($roles)->sortByDesc('creation_date')->values()->all();

        return view('role-listings', compact('roles'));
    }
}
