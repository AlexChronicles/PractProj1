<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;


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
Route::middleware(['check.auth','check.blocked'])->group(function(){

    Route::controller(UserController::class)->group(function(){
        Route::put('/users/{user}', 'update')->name('users.update');
        Route::delete('/users/{user}', 'destroy')->name('users.destroy');
    });

    // Ex2
    Route::controller(MovieController::class)->group(function(){
        Route::get('movies', 'index')->name('movies.index');
        Route::post('movies/{user}/{movie_id}', 'favorite')->name('movies.favorite');
        Route::delete('movies/{user}/{movie_id}', 'delfavorite')->name('movies.delfavorite');
        Route::get('movies/{user}', 'indexunfavorite')->name('movies.indexunfavorite');
    });
});

Route::middleware('check.blocked')->get('users', [UserController::class,'index'])->name('users.index');
Route::middleware('check.blocked')->get('users/{user}',[UserController::class,'show'])->name('users.show');

// Ex3
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);