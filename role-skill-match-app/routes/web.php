<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UpdateRoleController;
use App\Http\Controllers\RoleController;

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
Route::get('/role-listings', [RoleController::class, 'retrieveAll']);


Route::get('/', function () {
    return view('welcome');
});

//store listing data
Route::post('/updateRole', [UpdateRoleController::class, 'store']);

//get listing 
Route::get('/edit/listingID={passedlisting}', [UpdateRoleController::class, 'autoFillRoleListing']);

//Route::get('/edit/listingID={passedlisting}', [UpdateRoleController::class, 'retrieveAllDepartments']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/alldept', [App\Http\Controllers\UpdateRoleController::class, 'retrieveAllSkills'])->name('home');

Route::get('/alldepartments', [App\Http\Controllers\UpdateRoleController::class, 'retrieveAllDepartments'])->name('home');

Route::get('/test2', [UpdateRoleController::class, 'retrieveAllHiringManagers']);
Route::get('/test', [UpdateRoleController::class, 'retrieveAllSkills']);
// Route::get('/edit', function () {
    
// });

//Route::get('/edit', [UpdateRoleController::class, 'index']);

