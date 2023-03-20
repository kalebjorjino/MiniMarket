<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfile;

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
Route::get('/vue', function() {
    return view('app');
});


// ============================== public routes ===============================
Route::controller(StorefrontController::class)->group(function(){
    Route::get('/', 'index'); // home
    Route::get('/contact-us', 'contact')->name('contact.show');
    Route::post('contact-us', 'contactSend')->name('contact.send');
});

Route::view('/about', 'storefront.about');
Route::view('/privacy-policy', 'storefront.privacy');
Route::view('/terms-conditions', 'storefront.terms');
Route::view('/help', 'storefront.help');

// MENU
Route::controller(MenuController::class)->prefix('menu')->group(function () {
    // show all products
    // show a product 
});

Auth::routes(['verify' => true,]);

// ============================== customer routes ===============================

// USER DASHBOARD
Route::prefix('account')->middleware('verified')->group(function () {
    Route::view('/dashboard', 'customer.dashboard');
    Route::view('/orders', 'customer.orders');
    Route::view('/profile', 'customer.profile');
    Route::view('/changePassword', 'customer.changePassword');
});
Route::post('userLogout', [HomeController::class, 'logout'])->name('userLogout');


// ================================ admin routes ================================
Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'index'])->name('adminLogin');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('adminLoginAuth');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('adminLogout');

    Route::middleware('admin.auth')->group(function () {

        // DASHBOARD
        Route::get('/', [DashboardController::class, 'index'])->name('adminDashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('adminDashboard');

        // PROFILE
        Route::get('profile', [AdminProfile::class, 'show'])->name('profile.show');
        Route::put('profile', [AdminProfile::class, 'update'])->name('profile.update');

        // ADMINS
        // Route::resource('admins', AdminController::class, [
        //     'only' => ['index', 'store', 'edit', 'update', 'destroy']
        // ]);
        Route::resource('admins', AdminController::class, [
            'except' => ['create', 'show']
        ]);

        // USERS / CUSTOMERS
        Route::resource('users', UserController::class, [
            'except' => ['create', 'show']
        ]);

        // ORDERS
        Route::resource('orders', OrderController::class, [
            'except' => ['create', 'show']
        ]);

        // PRODUCTS
        Route::resource('products', ProductController::class, [
            'except' => ['show']
        ]);
        Route::post('products/media', [ProductController::class, 'storeMedia'])->name('products.storeMedia');

        // CATEGORIES
        Route::resource('categories', CategoryController::class, [
            'except' => ['create', 'show']
        ]);

        // BRANDS
        Route::resource('brands', BrandController::class, [
            'except' => ['create', 'show']
        ]);

        // EXPENSES
        Route::resource('expenses', ExpenseController::class, [
            'except' => ['create', 'show']
        ]);
        Route::get('getProduct', [ExpensesController::class, 'getProduct'])->name('getProduct');


        Route::view('about', 'admin.about')->name('about');

        // REF
        // Route::get('/dashboard', 'Admin\DashboardController@index')->name('adminDashboard');
    });

});

