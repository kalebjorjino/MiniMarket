<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mobile\AuthController;
use App\Http\Controllers\Mobile\CartController;
use App\Http\Controllers\Mobile\OrderController;
use App\Http\Controllers\Mobile\ProductController;
use App\Http\Controllers\Mobile\ProfileController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Auth + Profile 
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/signup','signup');
});

Route::controller(ProfileController::class)->group(function () {
    Route::post('/profile','editProfile');
    Route::post('/profile-password', 'editPassword');
    Route::post('/get-profile', 'getProfile');
});

Route::controller(OrderController::class)->group(function () {
    Route::post('/get-orders', 'getOrders');
    Route::post('/cancel-order', 'cancelOrder');
});

Route::controller(CartController::class)->prefix('cart')->group(function () {
    Route::get('/get-cart-items/{id}', 'getCartItems');
    Route::post('/get-cart-items', 'getAllCartItems');
    Route::post('/update-quantity', 'updateQuantity');
    Route::post('/checkout', 'checkout');
    Route::post('/removetocart', 'removeToCart');
});

Route::controller(ProductController::class)->prefix('product')->group(function () {
    Route::post('/get-product', 'getProduct');
    Route::post('/add-to-cart', 'addToCart');
    Route::get('/get-products', 'getProducts');
});
