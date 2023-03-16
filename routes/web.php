<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Config\LogsController;
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

// CONFIG
Route::prefix('config')->group(function () {
    // LOGS
    Route::get('/logs', [ LogsController::class, 'index' ])
        ->middleware('auth')
        ->middleware('allow:logs')
        ->name('logs');
    Route::get('/logs/name/{name}', [LogsController::class, 'name'])
        ->middleware('auth')
        ->middleware('allow:logs')
        ->name('logs.name');
});

// SEARCH
Route::post('/search',[\App\Http\Controllers\SearchController::class,'get'])
    ->middleware('auth')
    ->name('search');
