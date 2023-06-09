<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::get('users', [AuthController::class, 'index'])->name('users.index');
Route::get('users/{id}', [AuthController::class, 'show'])->name('users.show');
Route::put('users/{id}', [AuthController::class, 'update'])->name('users.update');
Route::delete('users/{id}', [AuthController::class, 'destroy'])->name('users.destroy');
Route::post('users', [AuthController::class, 'create'])->name('users.create');