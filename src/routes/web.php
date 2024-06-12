<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\UserController;
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
    Route::get('/', [AttendanceController::class, 'index']);
    Route::get('/attendance', [AttendanceController::class, 'attendance']);
    Route::get('/attendance/move', [AttendanceController::class, 'attendanceMove']);
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/search', [UserController::class, 'search']);
    Route::get('/user/record', [UserController::class, 'record']);
    Route::get('/user/record/move', [UserController::class, 'recordMove']);
    Route::post('/attend', [AttendanceController::class, 'addAttendTime']);
    Route::post('/leaving', [AttendanceController::class, 'addLeavingTime']);
    Route::post('/break-start', [AttendanceController::class, 'addBreakStartTime']);
    Route::post('/break-finish', [AttendanceController::class, 'addBreakFinishTime']);
});
