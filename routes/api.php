<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::name("auth.")->prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
});

Route::middleware('auth:sanctum')->name("auth.")->prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('check-token', 'checkToken')->name('checkToken');
    Route::post('logout', 'logout')->name('logout');
});
