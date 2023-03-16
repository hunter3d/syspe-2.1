<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Config\LogsController;
use App\Http\Controllers\ExhibitionsController;
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

// EXHIBITIONS
Route::prefix('exhibitions')->group(function () {
    Route::get('/index', [ExhibitionsController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:exhibitions')
        ->name('exhibitions');
    Route::get('/add', [ExhibitionsController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:exhibitions create')
        ->name('exhibitions.create');
    Route::post('/add', [ExhibitionsController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:exhibitions store')
        ->name('exhibitions.store');
    Route::get('/edit/{id}', [ExhibitionsController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:exhibitions edit')
        ->name('exhibitions.edit');
    Route::post('/edit/{id}', [ExhibitionsController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:exhibitions update')
        ->name('exhibitions.update');
    Route::get('/delete/{id}', [ExhibitionsController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('allow:exhibitions destroy')
        ->name('exhibitions.destroy');
});
