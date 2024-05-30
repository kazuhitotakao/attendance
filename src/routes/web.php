<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/attend', [AttendanceController::class, 'addAttendTime']);
    Route::post('/leaving', [AttendanceController::class, 'addLeavingTime']);
    Route::post('/break-start', [AttendanceController::class, 'addBreakStartTime']);
    Route::post('/break-finish', [AttendanceController::class, 'addBreakFinishTime']);
});
