<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;

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

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/', [AuthController::class, 'checkLogin']);

Route::get('/showBooks', [BookController::class, 'showBooks'])->name('showBooks');

Route::post('/showBooks', [BookController::class, 'searchBook']);

Route::get('/showSearchBook', [BookController::class, 'showSearchBook'])->name('showSearchBook');
