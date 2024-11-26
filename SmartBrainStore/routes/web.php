<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
// đăng nhập
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
// đăng ký
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'registerUser']);

// điều hướng đến home
Route::get('/home', function () {
    return view('client.home');
})->name('home');

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
