<?php

use App\Http\Controllers\AuthController;
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

Route::get('/loging', [AuthController::class,'pageLoging'])->name('loging');
Route::post('/loging', [AuthController::class,'auth_user'])->name('loging_post');
Route::get('/log-out', [AuthController::class,'logout'])->name('logout');

//check the auth of user before acceing the pages
Route::middleware('AuthMiddleware')->group(function () {

    Route::get('/book/{id}',)->name('book');

    Route::get('/', function () {
        return view('Users.book');
    })->name('home');

    Route::get('/count', function () {
        return view('Users.account');
    });

    Route::get('/profile', function () {
        return view('Users.profile');
    });

    Route::get('/list', function () {
        return view('Users.playlist');
    });

    Route::get('/history', function () {
        return view('Users.history');
    });
});
