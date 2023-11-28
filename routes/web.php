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

Route::get('/book', function () {
    return view('Users.book');
});


Route::get('/log', function () {
    return view('login');
});

Route::get('count', function () {
    return view('Users.account');
});
Route::get('list', function () {
    return view('Users.playlist');
});

Route::get('/', function () {
    return view('pranck');
});
