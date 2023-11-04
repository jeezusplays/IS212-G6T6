<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UpdateRoleController;
use App\Http\Controllers\ViewRoleApplicants;
use App\Http\Controllers\ViewRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawApplication;
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

Route::get('/staff_id={staff_id}/indicate-skill-proficiency', [App\Http\Controllers\IndicateSkillProficiency::class, 'autoFillSkills']);

//store skill-proficiency data
Route::post('/update-skill-proficiency', [App\Http\Controllers\IndicateSkillProficiency::class, 'store'])->name('index.store');

// Update application withdraw data
Route::post('/withdraw', [ViewRoleController::class, 'withdrawApplication'])->name('withdraw');

// Route for role listings page
Route::get('/staff_id={staff_id}/role-listings', [RoleController::class, 'index']);

// Route for view-role-applicants page
Route::get('/staff_id={staff_id}/view-role-applicants/listingID={passedlisting}', [App\Http\Controllers\ViewRoleApplicants::class, 'getApplicantListing']);

// Route for create role
Route::get('/staff_id={staff_id}/create-role', [RoleController::class, 'setup']);

Route::get('/staff_id={staff_id}/browse-roles', [App\Http\Controllers\BrowseAllRoleController::class, 'index_view'])->name('browse-roles');
Route::get('/view-role-applicants/listingID={passedlisting}', [ViewRoleApplicants::class, 'getApplicantListing']);

Route::post('/create-role', [RoleController::class, 'store'])->name('create-role');

//Route for edit listing
Route::get('staff_id={currentStaffID}/edit/listingID={passedlisting}', [UpdateRoleController::class, 'autoFillRoleListing']);

Route::post('/updateRole', [UpdateRoleController::class, 'store']);

Route::get('staff_id={currentStaffID}/view-role/listingID={passedlisting}', [ViewRoleController::class, 'getListing']);

// post request to apply for a role as staff
Route::post('/apply_role', [ApplicationController::class, 'store'])->name('apply-role');
Route::get('/apply', function () {
    return view('apply-role');
});

// view application status
Route::get('/view-app-status', function () {
    return view('view-app-status');
});

Route::get('/staff_id={staff_id}/view-my-applications', [App\Http\Controllers\ViewMyApplicationsController::class, 'getMyApplications'])->name('view-all-applications');

Route::redirect('/', '/staff_id=1/browse-roles');
