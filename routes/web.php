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

Route::get('/dashboard', 'DashboardController@index');

// Users
Route::resource('users', UserController::class);

// Roles
Route::resource('roles', RoleController::class);

// Permissions
Route::resource('permissions', PermissionController::class);

// Time Tables
Route::resource('time_tables', TimeTableController::class);

// Workouts Of Days
Route::resource('workouts_of_days', WorkOutsOfDayController::class);

require __DIR__.'/auth.php';
