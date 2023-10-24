<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UpdateRoleController;
use App\Http\Controllers\ViewRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
// Route for indicate-skill-proficiency page
Route::get('/indicate-skill-proficiency', [App\Http\Controllers\IndicateSkillProficiency::class, 'index']);
Route::get('/hr/indicate-skill-proficiency/staffID={passedlisting}', [App\Http\Controllers\IndicateSkillProficiency::class, 'autoFillSkills']);
Route::get('/staff/indicate-skill-proficiency/staffID={passedlisting}', [App\Http\Controllers\IndicateSkillProficiency::class, 'autoFillSkills']);
Route::get('manager/indicate-skill-proficiency/staffID={passedlisting}', [App\Http\Controllers\IndicateSkillProficiency::class, 'autoFillSkills']);


//store skill-proficiency data
Route::post('/update-skill-proficiency', [App\Http\Controllers\IndicateSkillProficiency::class, 'store'])->name('index.store');

// Route for role listings page
Route::get('/hr/role-listings', [RoleController::class, 'index']);
Route::get('/manager/role-listings', [RoleController::class, 'index']);


// Route for view-role-applicants page
Route::get('/hr/view-role-applicants/listingID={passedlisting}', [App\Http\Controllers\ViewRoleApplicants::class, 'getApplicantListing']);
Route::get('/manager/view-role-applicants/listingID={passedlisting}', [App\Http\Controllers\ViewRoleApplicants::class, 'getApplicantListing']);

// Route for browse-roles page
Route::get('/hr/browse-roles', [App\Http\Controllers\BrowseAllRoleController::class, 'index_view'])->name('browse-roles');
Route::get('/manager/browse-roles', [App\Http\Controllers\BrowseAllRoleController::class, 'index_view'])->name('browse-roles');
Route::get('/staff/browse-roles', [App\Http\Controllers\BrowseAllRoleController::class, 'index_view'])->name('browse-roles');


// Route for create role
Route::get('/hr/create-role', [RoleController::class, 'setup']);
Route::get('/manager/create-role', [RoleController::class, 'setup']);

Route::post('/create-role', [RoleController::class, 'store'])->name('create-role');

//Route for edit listing
Route::get('/hr/edit/listingID={passedlisting}', [UpdateRoleController::class, 'autoFillRoleListing']);
Route::get('/manager/edit/listingID={passedlisting}', [UpdateRoleController::class, 'autoFillRoleListing']);
Route::post('/updateRole', [UpdateRoleController::class, 'store']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

// post request to apply for a role as staff
Route::post('/apply', [ApplicationController::class, 'store'])->name('apply-role');
Route::get('/apply', function () {
    return view('apply-role');
});

// Route for view role details from browse roles page
Route::get('/hr/view-role/listingID={passedlisting}', [ViewRoleController::class, 'getListing']);
Route::get('/manager/view-role/listingID={passedlisting}', [ViewRoleController::class, 'getListing']);
Route::get('/staff/view-role/listingID={passedlisting}', [ViewRoleController::class, 'getListing']);


Route::get('/', function () {
    return view('welcome');
});