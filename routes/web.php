<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [App\Http\Controllers\app\UserController::class, 'login'])->name("login"); 
Route::post('/login', [App\Http\Controllers\app\UserController::class, 'loginUser']); 
Route::get('/register', [App\Http\Controllers\app\UserController::class, 'register']); 
Route::post('/register', [App\Http\Controllers\app\UserController::class, 'store']); 

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    
    Route::group(['middleware' => ['withCompany']], function () {
        
        // Users
        Route::resource('users', App\Http\Controllers\app\UserController::class); 
        Route::post('/delete-user/{user}', [App\Http\Controllers\app\UserController::class, "delete"]); 
        Route::post('/update-user/{user}', [App\Http\Controllers\app\UserController::class, "update"]); 
        
        // Roles
        Route::resource('roles', App\Http\Controllers\app\RoleController::class); 
        Route::post('/delete-role/{role}', [App\Http\Controllers\app\RoleController::class, "delete"]); 
        Route::post('/update-role/{role}', [App\Http\Controllers\app\RoleController::class, "update"]); 

        // logout 
        Route::get('/logout', [App\Http\Controllers\app\UserController::class, 'logout']); 
        Route::post('/logout', [App\Http\Controllers\app\UserController::class, 'logout']); 

        Route::get('/', [App\Http\Controllers\app\HomeController::class, 'index']); 

        // Places
        Route::resource('places', App\Http\Controllers\app\PlaceController::class); 
        Route::get('/waiting-list', [App\Http\Controllers\app\HomeController::class, 'waitingList']); 
    });

    // company
    Route::resource('company', App\Http\Controllers\app\CompanyController::class);     
    Route::post('/delete-company/{company}', [App\Http\Controllers\app\CompanyController::class, "delete"]); 
    Route::post('/update-company/{company}', [App\Http\Controllers\app\CompanyController::class, "update"]); 
    Route::post('/change-company/{company}', [App\Http\Controllers\app\CompanyController::class, "changeCompany"]); 
});