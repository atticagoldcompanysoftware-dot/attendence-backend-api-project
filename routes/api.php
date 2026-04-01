<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/employee/login', [EmployeeAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/employee/profile', [EmployeeAuthController::class, 'profile']);
    Route::post('/employee/logout', [EmployeeAuthController::class, 'logout']);

    Route::get('/attendance/latest', [AttendanceController::class, 'latest']);
    Route::get('/attendance/history', [AttendanceController::class, 'history']);
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn']);
    Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut']);
});
