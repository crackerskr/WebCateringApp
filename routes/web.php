<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MobileController;
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

Route::get('/', function () {
    return view('login');
});

// Login
Route::get('login',[UserController::class,'login']);
Route::post('login',[UserController::class,'authenticateAdmin']);

// Register
Route::get('signup',[UserController::class,'create']);
Route::post('signup',[UserController::class,'storeUser']);

// Show homepage
Route::view('homepage', 'homepage')->name('homepage');

// Show Menu based on Category
Route::get('menu/{category}', [WebController::class, 'showMenu'])->name('menu');

// Add Menu
Route::get('menu/{category}/add', [WebController::class, 'showFoodInclude']);
Route::post('addMenu',[WebController::class,'addMenu']);


// Show Edit Menu Form
Route::get('menu/{id}/edit',[WebController::class, 'showMenuDetails']);
// Update Menu
Route::put('editMenu',[WebController::class, 'updateMenu']);

//Delete Menu
Route::delete('/menu/{category}/{id}/delete', [WebController::class, 'deleteMenu']);



// Show Order
Route::get('order', [WebController::class, 'showOrder']);

// Show Order Details
Route::get('order/{id}', [WebController::class, 'showOrderDetails']);

// Update Order Status to Complete
Route::put('/order/{id}/complete', [WebController::class, 'CompleteOrder']);

// Update Order Status to Cancelled
Route::put('/order/{id}/cancel', [WebController::class, 'CancelOrder']);

// Logout
Route::get('logout', [UserController::class,'logout']);


