<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ExhibitionsController;
use App\Http\Controllers\API\TextsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('/login',[ AuthController::class, 'login' ])
        ->middleware('localization');
    Route::get('/logout',[AuthController::class, 'destroy'])
        ->middleware('localization')
        ->middleware('auth:sanctum');
    Route::post('/remember',[AuthController::class, 'remember'])
        ->middleware('localization');
    Route::post('/recovery',[AuthController::class,'recovery'])
        ->middleware('localization');
});

Route::get('/texts/{id}',[ TextsController::class,'show'])
    ->middleware('localization');

Route::get('/exhibitions',[ ExhibitionsController::class,'index'])
    ->middleware('localization');
//Route::get('/exhibition/{id}',[ ExhibitionsController::class,'show'])
//    ->middleware('localization');
