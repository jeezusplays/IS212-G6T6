<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UpdateRoleController;


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

Route::get('/', function(){
    return view("welcome");
});

//store listing data
Route::post('/updateRole', [UpdateRoleController::class, 'store']);

//get listing 
Route::get('/edit/roleID={passedrole}/listingID={passedlisting}', [UpdateRoleController::class, 'retrieveRoleListing']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/alldept', [App\Http\Controllers\UpdateRoleController::class, 'retrieveAllSkills'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', [UpdateRoleController::class, 'retrieveAllSkills']);
// Route::get('/edit', function () {
    
// });

//Route::get('/edit', [UpdateRoleController::class, 'index']);

