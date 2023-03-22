<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Config\LogsController;
use App\Http\Controllers\Config\RolesController;
use App\Http\Controllers\Config\StaffController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ExhibitionsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ScanerController;
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
//
Route::get('/', [MainController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::prefix('messages')->group(function () {
    Route::get('/add', [MainController::class, 'create'])
        ->middleware('auth')
        ->name('messages.create');
    Route::post('/add', [MainController::class, 'store'])
        ->middleware('auth')
        ->name('messages.store');
    Route::get('/edit/{id}', [MainController::class, 'edit'])
        ->middleware('auth')
        ->name('messages.create');
    Route::post('/edit/{id}', [MainController::class, 'update'])
        ->middleware('auth')
        ->name('messages.update');
    Route::get('/delete/{id}', [MainController::class, 'destroy'])
        ->middleware('auth')
        ->name('messages.destroy');
});

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
    // STAFF
    Route::get('/staff', [StaffController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:staff')
        ->name('staff');
    Route::get('/staff/add', [StaffController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:staff create');
    Route::post('/staff/add', [StaffController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:staff store');
    Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:staff edit');
    Route::post('/staff/edit/{id}', [StaffController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:staff update');
    Route::get('/staff/block/{id}', [StaffController::class, 'block'])
        ->middleware('auth')
        ->middleware('allow:staff block');
    // ROLES
    Route::get('/roles', [RolesController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:roles')
        ->name('roles');
    Route::get('/roles/add', [RolesController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:roles create');
    Route::post('/roles/add', [RolesController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:roles store');
    Route::get('/roles/edit/{id}', [RolesController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:roles destroy');
    Route::post('/roles/edit/{id}', [RolesController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:roles update');
    Route::get('/roles/delete/{id}', [RolesController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('allow:roles destroy');
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

// EVENTS
Route::prefix('events')->group(function () {
    Route::get('/index', [EventsController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:events')
        ->name('events');
    Route::get('/exhibition/{id}', [EventsController::class, 'exhibition'])
        ->middleware('auth')
        ->middleware('allow:events')
        ->name('events:exhibition');
    Route::get('/show/{id}', [EventsController::class, 'show'])
        ->middleware('auth')
        ->middleware('allow:events')
        ->name('events.show');
    Route::get('/exhibition/{id}', [EventsController::class, 'exhibition'])
        ->middleware('auth')
        ->middleware('allow:events')
        ->name('events.exhibition');
    Route::get('/add', [EventsController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:events create')
        ->name('events.create');
    Route::post('/add', [EventsController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:events store')
        ->name('events.store');
    Route::get('/edit/{id}', [EventsController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:events edit')
        ->name('events.create');
    Route::post('/edit/{id}', [EventsController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:events update')
        ->name('events.update');
    Route::get('/delete/{id}', [EventsController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('allow:events destroy')
        ->name('events.destroy');
});

// PROMOCODES
Route::prefix('promocodes')->group(function () {
    Route::get('/index', [PromocodesController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:promocodes')
        ->name('promocodes');
    Route::get('/event/{id}', [PromocodesController::class, 'event'])
        ->middleware('auth')
        ->middleware('allow:promocodes')
        ->name('promocodes.event');
    Route::get('/add', [PromocodesController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:promocodes add');
    Route::post('/add', [PromocodesController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:promocodes add');
    Route::get('/edit/{id}', [PromocodesController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:promocodes edit');
    Route::post('/edit/{id}', [PromocodesController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:promocodes edit');
    Route::get('/delete/{id}', [PromocodesController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('allow:promocodes delete');
});

// Scaner
Route::prefix('scaner')->group(function () {
    Route::get('index', [ScanerController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:scaner')
        ->name('scaner');
});
