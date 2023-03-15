<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// AUTH
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])
        ->middleware('guest')
        ->name('login');
    Route::post('/login', [AuthController::class, 'store'])
        ->middleware('guest');
    Route::get('/logout', [AuthController::class, 'destroy'])
        ->middleware('auth');
});
