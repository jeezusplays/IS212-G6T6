<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UpdateRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewRoleController;

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
Route::get('/role-listings', [RoleController::class, 'index']);

# Route for browse-roles page
Route::get('browse-roles', [App\Http\Controllers\BrowseAllRoleController::class, 'index_view'])->name('browse-roles');

Route::get('/create-role', [RoleController::class, 'setup']);
Route::post('/create-role', [RoleController::class, 'store'])->name('create-role');

Route::get('/', function () {
    return view('welcome');
});

//store listing data
Route::post('/updateRole', [UpdateRoleController::class, 'store']);

//get listing
Route::get('/edit/listingID={passedlisting}', [UpdateRoleController::class, 'autoFillRoleListing']);

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/alldept', [UpdateRoleController::class, 'retrieveAllSkills'])->name('home');

// Route::get('/alldepartments', [UpdateRoleController::class, 'retrieveAllDepartments'])->name('home');

Route::get('/hiringManagerDDL', [UpdateRoleController::class, 'retrieveAllHiringManagers']);
Route::get('/skillsDDL', [UpdateRoleController::class, 'retrieveAllSkills']);

// post request to apply for a role as staff
Route::get('/apply', [ApplicationController::class, 'store'])->name('apply-role');
Route::post('/apply', [ApplicationController::class, 'store'])->name('apply-role');
Route::get('/apply', function () {
    return view('apply-role');
});
Route::get('/view-role/listingID={passedlisting}', [ViewRoleController::class, 'getListing']);
