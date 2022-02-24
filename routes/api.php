<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Register User
Route::post('register/user','RegisterController@register');

// Login User
Route::post('login/user','LoginController@login');

// Return Time Tables Listing
Route::get('listing/timetable','ReturnDataListingController@timetables');
