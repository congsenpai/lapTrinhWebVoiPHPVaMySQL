<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
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
// product details
Route::get('/product/{id}', [ProductController::class, 'showProductDetail'])->name('productdetail');
Route::get('/api/product/{id}', [ProductController::class, 'showProductDetailJson']);



// các route dành cho admin
// Default
Route::get('admin', [AuthController::class, 'showLoginAdminForm']);
// auth
Route::get('login/admin', [AuthController::class, 'showLoginAdminForm'])->name('loginAsAdmin');
Route::post('login/admin', [AuthController::class, 'loginAsAdmin'])->name('loginAsAdmin');
// dashboard
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('check.role:admin,staff');
// trang nhân viên
Route::get('admin/staff', [UserController::class, 'showAdminStaffForm'])->name('adminstaff')->middleware('check.role:admin,staff');
// trang thương hiệu
Route::get('admin/brand', [BrandController::class, 'showAdminBrandForm'])->name('adminbrand')->middleware('check.role:admin,staff');
// trang loại sản phẩm
Route::get('admin/category', [CategoryController::class, 'showAdminCategoryForm'])->name('admincategory')->middleware('check.role:admin,staff');
// trang sản phẩm
// trang product
Route::get('admin/product', [ProductController::class, 'getAllProduct'])->name('adminproduct')->middleware('check.role:admin,staff');
Route::get('/addproduct', [ProductController::class, 'create'])->name('addproduct');
Route::post('/addproduct', [ProductController::class, 'store'])->name('addproduct');
// trang hóa đơn
Route::get('admin/order', [OrderController::class, 'showAdminOrderForm'])->name('adminorder')->middleware('check.role:admin,staff');
// trang khách hàng
Route::get('admin/customer', [CustomerController::class, 'showAdminCustomerForm'])->name('admincustomer')->middleware('check.role:admin,staff');
// trang voucher
Route::get('admin/voucher', [VoucherController::class, 'showAdminVoucherForm'])->name('adminvoucher')->middleware('check.role:admin,staff');
// trang khuyến mãi
Route::get('admin/promotion', [PromotionController::class, 'showAdminPromotionForm'])->name('adminpromotion')->middleware('check.role:admin,staff');
// trang đổi mật khẩu
Route::get('admin/changepassword', [AuthController::class, 'showAdminChangePassForm'])->name('adminchangepass')->middleware('check.role:admin,staff');