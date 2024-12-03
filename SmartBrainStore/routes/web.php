<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Các route dành cho client
// đăng nhập
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// đăng ký
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'registerUser']);

// quên mật khẩu
Route::get('forgotpassword', [AuthController::class, 'showForgotPassForm'])->name('forgotpassword');
Route::post('/forgotpassword', [AuthController::class, 'forgotPassword'])->name('forgotpassword');

// route lấy lại mật khẩu
Route::get('/resetpassword/{token}', function ($token) {
    return view('client.auth.resetpassword', ['token' => $token]);
})->name('resetpassword');

Route::post('resetpassword', [AuthController::class, 'resetPassword'])->name('updatepassword');

// điều hướng đến home
Route::get('/home', function () {
    return view('client.home');
})->name('home');

Route::get('/', function () {
    return view('index');
})->name('index');

// trang product
Route::get('/product', [ProductController::class, 'index'])->name('product');



// các route dành cho admin
// auth
Route::get('login/admin', [AuthController::class, 'showLoginAdminForm'])->name('loginAsAdmin');
Route::post('login/admin', [AuthController::class, 'loginAsAdmin'])->name('loginAsAdmin');
// dashboard
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('check.role:admin,staff');
// trang product
Route::get('admin/product', [ProductController::class, 'showAdminProductForm'])->name('adminproduct');
// trang add product
Route::get('/addproduct', [ProductController::class, 'create'])->name('addproduct');
Route::post('/addproduct', [ProductController::class, 'store'])->name('addproduct');