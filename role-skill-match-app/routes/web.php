<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\RoleController;

// Route::get('/create-role', [RoleController::class, 'index']);

Route::get('/role-listings', [RoleController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});


// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Format of Livewire App

Route::get('/create-role', function () {
    return view('create-role',[
        'header' => "Create Role",

         //this is the values to pass into frontend, possibly from backend
         //retrieved values from role listing
        'roleID' => 0,
        'title' => "",
        'max' => 10,
        'hiring_managers' => [
            'Derek Tan (Sales)', 
            'Ernest Sim (Consultancy Division)', 
            'Eric Loh (System Solutioning)', 
            'Philip Lee (Engineering Operation)', 
            'Sally Loh (HR and Admin)', 
            'David Yap (Finance)', 
            'Peter Yap (IT)'
        ],
        'vacancy' => 0,
        'deadline' => "",
        'skills' =>  [],
        'description' => "", 
        'deptDDL' => [
            [
                "deptID" => 1,
                "department" => "Sales"
            ],
            [
                "deptID" => 2,
                "department" => "IT"
            ],
            [
                "deptID" => 3,
                "department" => "Consultancy Division"
            ],
            [
                "deptID" => 4,
                "department" => "System Solutioning"
            ],
            [
                "deptID" => 5,
                "department" => "Engineering Operation"
            ],
            [
                "deptID" => 6,
                "department" => "HR and Admin"
            ],
            [
                "deptID" => 7,
                "department" => "Finance"
            ]
            ],

        'workArrangementDDL' => [
            [
                "workArrangementID" => 1,
                "workArrangement" => "Part Time"
            ],
            [
                "workArrangementID" => 2,
                "workArrangement" => "Full Time"
            ]
            ],
            // 'Part Time', 'Full Time'
        

        'hiringManagerDDL' => [ 
            [   
                "empID" => 1,
                "name" => "Derek Tan (Sales)"
            ],

            [
                "empID" => 2,
                "name" => "Ernest Sim (Consultancy Division)"
            ],

            [
                "empID" => 3,
                "name" => "Eric Loh (System Solutioning)"
            ],
            [
                "empID" => 4,
                "name" => "Philip Lee (Engineering Operation)"
            ],
            [
                "empID" => 5,
                "name" => "Sally Loh (HR and Admin)"
            ],
            [
                "empID" => 6,
                "name" => "David Yap (Finance)"
            ],
            [
                "empID" => 7,
                "name" => "Peter Yap (IT)"
            ],
        ],

        'skillsDDL' => [
            [
                "skillID" => 1,
                "skill" => "Python"
            ],
            [
                "skillID" => 2,
                "skill" => "Excel"
            ],
            [
                "skillID" => 3,
                "skill" => "Management"
            ],
            [
                "skillID" => 4,
                "skill" => "Accounting"
            ]
        ],

        'dummyRoleList' => [
            [
                "roleID" => 1,
                "title" => "Sales Manager",
                "max" => 10,
                "hiring_managers" => [
                    "Derek Tan (Sales)", 
                    "Ernest Sim (Consultancy Division)", 
                    "Eric Loh (System Solutioning)", 
                    "Philip Lee (Engineering Operation)", 
                    "Sally Loh (HR and Admin)", 
                    "David Yap (Finance)", 
                    "Peter Yap (IT)"
                ],
                "vacancy" => 0,
                "deadline" => "2021-10-10",
                "skills" =>  [
                    "Python",
                    "Excel",
                    "Management",
                    "Accounting"
                ],
                "description" => "Sales Manager", 
                "dept" => "Sales",
                "workArrangement" => "Full Time"
            ],

            [
                "roleID" => 2,
                "title" => "Sales Manager",
                "max" => 10,
                "hiring_managers" => [
                    "Derek Tan (Sales)", 
                    "Ernest Sim (Consultancy Division)", 
                    "Eric Loh (System Solutioning)", 
                    "Philip Lee (Engineering Operation)", 
                    "Sally Loh (HR and Admin)", 
                    "David Yap (Finance)", 
                    "Peter Yap (IT)"
                ],
                "vacancy" => 0,
                "deadline" => "2021-10-10",
                "skills" =>  [
                    "Python",
                    "Excel",
                    "Management",
                    "Accounting"
                ],
                "description" => "Sales Manager", 
                "dept" => "Sales",
                "workArrangement" => "Full Time"
            ],

            [
                "roleID" => 3,
                "title" => "Sales Manager",
                "max" => 10,
                "hiring_managers" => [
                    "Derek Tan (Sales)", 
                    "Ernest Sim (Consultancy Division)", 
                    "Eric Loh (System Solutioning)", 
                    "Philip Lee (Engineering Operation)", 
                    "Sally Loh (HR and Admin)", 
                    "David Yap (Finance)", 
                    "Peter Yap (IT)"
                ],
                "vacancy" => 0,
                "deadline" => "2021-10-10",
                "skills" =>  [
                    "Python",
                    "Excel",
                    "Management",
                    "Accounting"
                ],
                "description" => "Sales Manager", 
                "dept" => "Sales",
                "workArrangement" => "Full Time",
            ],
            [
                "roleID" => 4,
                "title" => "",
                "max" => 10,
                "hiring_managers" => [
                ],
                "vacancy" => 0,
                "deadline" => "",
                "skills" =>  [
                ],
                "description" => "", 
                "dept" => "",
                "workArrangement" => "",
            ]   
    ]
    ]);
}); 