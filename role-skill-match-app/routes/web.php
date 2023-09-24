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

// Route for Role Creation
Route::post('/create-role', [RoleController::class, 'store']);
Route::post('/create-role-test', [RoleController::class, 'getData'])->name('Role.create');
// Route::view('/create-role', '/create-role');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create-role', function () {
    return view('create-role',[
        'header' => "Create Role",
        // 'role' =>$existingRole,

         //this is the values to pass into frontend, possibly from backend
         //retrieved values from role listing
        'Role_Name' => '',
        'title' => "",
        'vacancy' => 0,
        'deadline' => "",
        'skills' =>  [],
        'description' => "", 
        'deptDDL' => [
            [
                "Department_ID" => 1,
                "Department" => "Sales"
            ],
            [
                "Department_ID" => 2,
                "Department" => "Consultancy"
            ],
            [
                "Department_ID" => 3,
                "Department" => "System Solutioning"
            ],
            [
                "Department_ID" => 4,
                "Department" => "Engineering"
            ],
            [
                "Department_ID" => 5,
                "Department" => "HR and Admin"
            ],
            [
                "Department_ID" => 6,
                "Department" => "Finance"
            ],
            [
                "Department_ID" => 7,
                "Department" => "IT"
            ]
        ],

        'workArrangementDDL' => [
            1,
            2
        ],
        

        'hiringManagerDDL' => [ 
            [   
                "Staff_ID" => 1,
                "Staff_FullName" => "Derek Tan"
            ],

            [
                "Staff_ID" => 2,
                "Staff_FullName" => "Ernest Sim"
            ],

            [
                "Staff_ID" => 3,
                "Staff_FullName" => "Eric Loh"
            ],
            [
                "Staff_ID" => 4,
                "Staff_FullName" => "Philip Lee"
            ],
            [
                "Staff_ID" => 5,
                "Staff_FullName" => "Sally Loh"
            ],
            [
                "Staff_ID" => 6,
                "Staff_FullName" => "David Yap"
            ],
            [
                "Staff_ID" => 7,
                "Staff_FullName" => "Peter Yap"
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
            
    ]
    ]);
}); 