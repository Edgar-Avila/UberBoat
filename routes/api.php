<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\TripController;
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

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('/find-nearby-drivers', [TripController::class, 'findNearbyDrivers'])->name('findNearbyDrivers');
    Route::put('/change-availability', [DriverController::class, 'changeAvailability'])->name('changeAvailability');
    Route::put('/update-location', [TripController::class, 'updateLocation'])->name('updateLocation');
});
