<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController as AdminProfile;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});


// public routes 
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::controller(ProductsController::class)->prefix('products')->group(function () {
    // show all products
    // show a product 
});

// TODO cart + checkout routing

Auth::routes();



// customer routes
Route::middleware(['auth','customer'])->group(function () {
  
});

// admin routes
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
        Route::resource('admins', AdminController::class);

        // USERS
        Route::get('users', [UserController::class, 'index'])->name('users.index');



       


        Route::view('about', 'admin.about')->name('about');


        // REF
        // Route::get('/dashboard', 'Admin\DashboardController@index')->name('adminDashboard');
    });

});

