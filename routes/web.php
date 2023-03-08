<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\Admin\AdminController;
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


// public routes 
Route::controller(StorefrontController::class)->group(function(){
    Route::get('/', 'index'); // home
    Route::get('/contact-us', 'contact')->name('contact.show');
    Route::post('contact-us', 'contactSend')->name('contact.send');
});

Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');

Route::view('/about', 'storefront.about');
Route::view('/privacy-policy', 'storefront.privacy');
Route::view('/terms-conditions', 'storefront.terms');
Route::view('/help', 'storefront.help');


Route::controller(MenuController::class)->prefix('menu')->group(function () {
    // show all products
    // show a product 
});

// TODO cart + checkout routing


Auth::routes();

// ============================== customer routes ===============================
// USER DASHBOARD
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth','customer'])->group(function () {
  
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
            'except' => ['create', 'show']
        ]);

        // CATEGORIES
        Route::resource('categories', CategoryController::class, [
            'except' => ['create', 'show']
        ]);

        // EXPENSES
        Route::resource('expenses', ExpenseController::class, [
            'except' => ['create', 'show']
        ]);

        // REPORTS
        Route::resource('reports', ReportController::class, [
            'except' => ['create', 'show']
        ]);

       


        Route::view('about', 'admin.about')->name('about');


        // REF
        // Route::get('/dashboard', 'Admin\DashboardController@index')->name('adminDashboard');
    });

});

