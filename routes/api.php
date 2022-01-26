<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Get all users
Route::get('users', 'App\Http\Controllers\UserController@getAllUsers');

// Create user
Route::post('users/create', 'App\Http\Controllers\UserController@createUser');

// Update user
Route::post('users/update/{id}', 'App\Http\Controllers\UserController@updateUser');
