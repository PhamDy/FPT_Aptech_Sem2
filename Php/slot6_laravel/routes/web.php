<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PerformanController;
use App\Http\Controllers\TimeSheetController;
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

// Đường dẫn đến trang đăng nhập
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/', [AuthController::class, 'checkLogin']);

Route::get('/logout', [AuthController::class, 'showLoginForm'])->name('logout');

Route::get('/attendance', [AttendanceController::class, 'showAttendance'])->name('attendance');

Route::post('/attendance', [TimeSheetController::class, 'attdendanceMorning']);

Route::get('/dashboard', [AttendanceController::class, 'showDashboard'])->name('dashboard');

Route::get('/performance/{id}', [PerformanController::class, 'showPerformance'])->name('performance.show');


