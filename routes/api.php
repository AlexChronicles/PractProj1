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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('check.auth')->put('/users/{user}',[UserController::class, 'update'])->name('users.update');
Route::middleware('check.auth')->delete('/users/{user}',[UserController::class, 'destroy'])->name('users.destroy');
Route::apiResource('users',UserController::class);

/*
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::middleware('check.auth')->get('users/{usid}', [UserController::class, 'show'])->name('users.show');
Route::middleware('check.auth')->put('users/{usid}', [UserController::class, 'update'])->name('users.update');
Route::middleware('check.auth')->delete('users/{usid}', [UserController::class, 'destroy'])->name('users.destroy');
Route::middleware('check.auth')->post('users', [UserController::class, 'create'])->name('users.create');
*/

// Ex2
Route::get('movies',[MovieController::class, 'index'])->name('movies.index');
Route::post('movies/{user}/{movie_id}',[MovieController::class, 'favorite'])->name('movies.favorite');
Route::delete('movies/{user}/{movie_id}',[MovieController::class, 'delfavorite'])->name('movies.delfavorite');
Route::get('movies/{user}',[MovieController::class, 'indexunfavorite'])->name('movies.indexunfavorite');

// Ex3

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);