<?php

use Illuminate\Http\Request;
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

Route::get('/role-listings', [RoleController::class, 'index']);


Route::get('/edit', function () {
    return view('updateRole',[
        'header' => "Update",

         //this is the values to pass into view, possibly from backend
         //retrieved values from role listing
        'roleID' => "0123",
        'title' => "Test Role",
        'workArrangement' => "Part Time",
        'department' => 1,
        'hiring_managers' => ["Alvin Ho", "Amy", "John"],
        'vacancy' => 1,
        'deadline' => "2023-10-10",
        'skills' =>  [1,2],
        'description' => "Test Job", 
        
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
                "department" => "HR"
            ]
            ],

        'workArrangementDDL' => [
            'Part Time', 'Full Time'
        ],

        'hiringManagerDDL' => [ //currently all staff
            'Amy', 'John', 'Latrice'
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
        ]
    ]);
});


<<<<<<< Updated upstream
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
=======
>>>>>>> Stashed changes
