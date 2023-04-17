<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
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


// ============================== public routes ===============================
Route::controller(StorefrontController::class)->group(function(){
    Route::get('/', 'index'); // home
    Route::get('/contact-us', 'contact')->name('contact.show');
    Route::post('/contact-us', 'contactSend')->name('contact.send');
});

Route::view('/about', 'storefront.about');
Route::view('/privacy-policy', 'storefront.privacy');
Route::view('/terms-conditions', 'storefront.terms');
Route::view('/help', 'storefront.help');

// MENU
Route::controller(MenuController::class)->prefix('menu')->group(function () {
    // show all products
    Route::get('/', 'index')->name('menu.index');
    // show a product 
    Route::get('/{product:slug}', 'show');
});


Auth::routes(['verify' => true,]);

// Route::post('/email/verification-notification', [HomeController::class, 'emailNotif'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ============================== customer routes ===============================

// USER DASHBOARD
Route::middleware('verified')->group(function () {

Route::controller(HomeController::class)->prefix('account')->group(function () {
    Route::get('/dashboard', 'dashboard');
    Route::get('/orders', 'orders')->name('customer.orders');
    Route::get('/orders/{trackingnumber}', 'orderShow')->name('customer.order');
    Route::post('/orders/{id}', 'orderCancel');
    Route::get('/profile', 'profile');
    Route::post('/profile', 'editProfile');
    Route::get('/change-password', 'changePassword');
    Route::post('/change-password', 'updateChangePassword');
});
Route::post('userLogout', [HomeController::class, 'logout'])->name('userLogout');


Route::post('/addtocart', [CartController::class, 'addToCart']);

// CART
Route::controller(CartController::class)->prefix('cart')->group(function () {
    Route::get('/','cartPage'); // cart
    Route::post('/delete','delete');
    Route::post('/update','update');
    Route::post('/request','requestOrder');
    Route::post('/data','cartData');

    Route::prefix('checkout')->group(function () {
        Route::get('/', 'checkout'); 
        Route::post('/', 'placeOrder')->name('placeOrder'); 
        Route::get('/payment/{tracking}', 'payment');
        Route::post('/payment', 'payOrder')->name('payOrder'); 
        Route::get('/order-success/{tracking}', 'orderSuccess');
    });
});

// Paypal URL
Route::get('/success', [CartController::class, 'success']); 
Route::get('/error', [CartController::class, 'error']); 

});
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
        Route::resource('admins', AdminController::class, [
            'except' => ['create', 'show']
        ]);

        // USERS / CUSTOMERS
        Route::resource('users', UserController::class, [
            'except' => ['create', 'show']
        ]);

        // ORDERS
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{tracking}', [OrderController::class, 'show']);
        Route::post('/orders/{payment}', [OrderController::class, 'updateStatus'])->name('orders.update');

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
        Route::get('getProduct', [ExpenseController::class, 'getProduct'])->name('getProduct');


        Route::view('about', 'admin.about')->name('about');

        // REF
         // Route::resource('admins', AdminController::class, [
        //     'only' => ['index', 'store', 'edit', 'update', 'destroy']
        // ]);
        // Route::get('/dashboard', 'Admin\DashboardController@index')->name('adminDashboard');
    });

});

