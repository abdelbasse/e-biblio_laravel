<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::get('/loging', [AuthController::class, 'pageLoging'])->name('loging');
Route::post('/loging', [AuthController::class, 'auth_user'])->name('loging_post');
Route::get('/log-out', [AuthController::class, 'logout'])->name('logout');

//check the auth of user before acceing the pages
Route::middleware('AuthMiddleware')->group(function () {
    //normal user page urls
    Route::get('/p', [UserController::class, 'page'])->name('profile');
    Route::post('/p', [UserController::class, 'update'])->name('profile_update');
    Route::post('/p/profile/update', [UserController::class, 'profileUpdate'])->name('profile.update');
    //home page
    Route::get('/h',)->name('user.accoun.home');


    Route::middleware('AccountMiddleware')->group(function () {
        Route::get('/list', function () {
            return view('Users.playlist');
        })->name('count.list');
    });
});
