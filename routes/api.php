<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileController;
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

// Mobile App
// Login User and Add Session
Route::post('login', [UserController::class, 'authenticateUser']);

// Register User Account
Route::post('register', [UserController::class, 'register']);

// Logout and Clear Session
Route::post('logout',[UserController::class, 'logoutUser']);

// Show Menu in Menu Screen
Route::get('menu/{category}', [MobileController::class, 'showMenu']);

// Show Menu Details in Menu Details Screen
Route::get('menu/{category}/{id}', [MobileController::class, 'showMenuDetails']);
