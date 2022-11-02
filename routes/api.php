<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UseCarController;
use \App\Http\Controllers\CarController;
use \App\Http\Controllers\UserController;

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

Route::post('/v1/car/use', [UseCarController::class, 'useCar']);

Route::post('/v1/car/return', [UseCarController::class, 'returnCar']);

Route::get('/v1/cars/free', [CarController::class, 'getFreeCars']);

Route::get('/v1/users/free', [UserController::class, 'getFreeUsers']);
