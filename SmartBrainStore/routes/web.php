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
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
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
// trang giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{rowId}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart', [CartController::class, 'updateAll'])->name('cartUpdateAll');
// trang thanh toán

Route::get('/dat-hang', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkoutPost');
Route::get('/checkout/vnPayCheck', [CheckoutController::class, 'vnPayCheck'])->name('checkout.vnpay');

// trang tra cứu thông tin hóa đơn
Route::get('/order/check', [OrderController::class, 'checkOrderForm'])->name('order.check');
Route::post('/order/check/result', [OrderController::class, 'checkOrder'])->name('order.check.result');
Route::get('/about', function () {
    return view('client.aboutus');
})->name('about');
// trang cập nhật thông tin tài khoản
Route::get('/account', [UserController::class, 'showAccountForm'])->name('account');
Route::post('/account/update', [UserController::class, 'updateCustomer'])->name('account.update');

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
Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
Route::post('/brand/create', [BrandController::class, 'store'])->name('brand.store');
Route::get('/brand/edit/{brand}', [BrandController::class, 'edit'])->name('brand.edit');
Route::post('/brand/edit/{brand}', [BrandController::class, 'update'])->name('brand.update');
Route::delete('/brand/delete/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');

// trang loại sản phẩm
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/edit/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

// trang sản phẩm
// trang product
Route::get('admin/product', [ProductController::class, 'getAllProduct'])->name('adminproduct')->middleware('check.role:admin,staff');
Route::get('admin/product', [ProductController::class, 'getAdminProduct'])->name('adminproduct')->middleware('check.role:admin,staff');
Route::post('admin/product', [ProductController::class, 'store'])->name('createproduct')->middleware('check.role:admin,staff');
Route::put('admin/product/{id}', [ProductController::class, 'update'])->name('updateproduct')->middleware('check.role:admin,staff');
Route::delete('admin/product/{id}', [ProductController::class, 'deleteProduct'])->name('deleteproduct')->middleware('check.role:admin,staff');;

// trang hóa đơn
Route::get('admin/order', [OrderController::class, 'showAdminOrderForm'])->name('adminorder')->middleware('check.role:admin,staff');
// trang khách hàng
Route::get('admin/customer', [CustomerController::class, 'showAdminCustomerForm'])->name('admincustomer')->middleware('check.role:admin,staff');
// trang voucher
Route::get('admin/voucher', [VoucherController::class, 'index'])->name('adminvoucher')->middleware('check.role:admin,staff');
Route::get('/voucher/create', [VoucherController::class, 'create'])->name('voucher.create');
Route::post('/voucher/store', [VoucherController::class, 'store'])->name('voucher.store');
Route::get('/voucher/edit/{voucher}', [VoucherController::class, 'edit'])->name('voucher.edit');
Route::put('/voucher/update/{voucher}', [VoucherController::class, 'update'])->name('voucher.update');
Route::delete('/voucher/delete/{voucher}', [VoucherController::class, 'destroy'])->name('voucher.destroy');

// trang khuyến mãi
Route::get('/admin/promotion', [PromotionController::class, 'getPromotions'])->name('adminpromotion')->middleware('check.role:admin,staff');
Route::get('admin/promotion/{id}', [PromotionController::class, 'showDetail'])->name('promotionshowdetail')->middleware('check.role:admin,staff');
Route::post('admin/promotion', [PromotionController::class, 'store'])->name('promotion.add')->middleware('check.role:admin,staff');
Route::put('/admin/promotion/{id}', [PromotionController::class, 'update'])->name('promotion.update')->middleware('check.role:admin,staff');
// trang đổi mật khẩu
Route::get('admin/changepassword', [AuthController::class, 'showAdminChangePassForm'])->name('adminchangepass')->middleware('check.role:admin,staff');
Route::post('admin/changepassword', [AuthController::class, 'changeAdminPassword'])->name('adminchangepass')->middleware('check.role:admin,staff');
// trang nhân viên
Route::get('admin/staff', [UserController::class, 'showAdminStaffForm'])->name('adminstaff')->middleware('check.role:admin,staff');
Route::post('admin/addstaff', [UserController::class, 'store'])->name('addstaff')->middleware('check.role:admin,staff');
Route::post('admin/updatestaff', [UserController::class, 'update'])->name('updatestaff')->middleware('check.role:admin,staff');
Route::get('/staff/delete/{email}', [UserController::class, 'delete'])->name('deletestaff')->middleware('check.role:admin,staff');
Route::get('/staff/search', [UserController::class, 'search'])->name('searchstaff');
// trang khách hàng
Route::get('admin/customer', [CustomerController::class, 'showAdminCustomerForm'])->name('admincustomer')->middleware('check.role:admin,staff');
Route::post('admin/addcustomer', [CustomerController::class, 'store'])->name('addcustomer')->middleware('check.role:admin,staff');
Route::post('admin/updatecustomer', [CustomerController::class, 'update'])->name('updatecustomer')->middleware('check.role:admin,staff');
Route::get('/customer/delete/{email}', [CustomerController::class, 'delete'])->name('deletecustomer')->middleware('check.role:admin,staff');
Route::get('/customer/search', [CustomerController::class, 'search'])->name('searchcustomer');
// trang hóa đơn
Route::get('admin/order', [OrderController::class, 'index'])->name('adminorder.index')->middleware('check.role:admin,staff');
Route::get('admin/order/{orderid}', [OrderController::class, 'showDetailOrder'])->name('adminorder.detail')->middleware('check.role:admin,staff');
Route::post('/admin/order/update-status', [OrderController::class, 'updateStatus'])->name('admin.order.update-status');
