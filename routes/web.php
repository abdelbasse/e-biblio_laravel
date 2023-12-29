<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\bookController;
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
    //home page
    Route::get('/h', [bookController::class, 'HomePage'])->name('home');

    Route::get('/', [bookController::class, 'HomePage'])->name('home.2');

    //liked and saved routes
    Route::get('/book/{id}/liked/', [UserController::class, 'saveLike'])->name('user.book.liked');
    Route::get('/book/{id}/saved/', [UserController::class, 'saveSaved'])->name('user.book.saved');
    //for list
    Route::get('/series/{id}/liked/', [UserController::class, 'toggleSeriesLike'])->name('user.series.liked');
    Route::get('/series/{id}/saved/', [UserController::class, 'toggleSeriesSaved'])->name('user.series.saved');

    Route::get('/activite/liked', [UserController::class, 'LikedBooks_List'])->name('user.likes');
    Route::get('/activite/mareked', [UserController::class, 'SavedBooks_List'])->name('user.saved');

    //liked and saved routes for user
    Route::get('/book/{id}/liked/', [UserController::class, 'saveLike'])->name('user.book.liked');
    Route::get('/book/{id}/saved/', [UserController::class, 'saveSaved'])->name('user.book.saved');


    Route::get('/return', function () {
        return redirect()->route('home');
    })->name('back');

    // histrory accecebel fo all
    Route::get('/history', [UserController::class, 'History'])->name('history');


    //page series book accesebel by all
    Route::get('/series/{id}', [bookController::class, 'seriesInfo'])->name('list.info');
    Route::post('/series/', [AccountController::class, 'AddToAccount'])->name('list.info.uplaod');

    //page book accesebel by all
    Route::get('/book/{id}', [bookController::class, 'bookInfo'])->name('book.info');
    Route::get('/book/open/{id}', [bookController::class, 'openFile'])->name('openFile');

    //normal user page urls
    Route::get('/p', [UserController::class, 'page'])->name('profile');
    Route::post('/p', [UserController::class, 'update'])->name('profile_update');
    Route::post('/p/profile/update', [UserController::class, 'profileUpdate'])->name('profile.update');
    
    Route::get('/acount/{id}', [UserController::class, 'GetAccountInfo'])->name('user.accoun.view');



    //page book accesebel by all
    Route::middleware('AdminMiddleware')->group(function () {
        Route::get('/ValidateRequest', [AdminController::class, 'validHomePage'])->name('admin.book.valide');
        Route::get('/ValidateRequest/valide/{id}/{isValid}', [AdminController::class, 'validBookAction'])->name('admin.book.valide.action');

        Route::get('/Channels', [AdminController::class, 'usersListHomePage'])->name('admin.users.list');
        Route::get('/Channels/valide/{id}/{isValid}', [AdminController::class, 'usersListUpdate'])->name('admin.users.list.update');
    });

    //pages fo account user
    Route::middleware('AccountMiddleware')->group(function () {
        Route::get('/acount', [AccountController::class, 'home'])->name('user.accoun.home');
        Route::post('/acount/addBook', [AccountController::class, 'AddToAccount'])->name('user.accoun.home.update');
    });


});
