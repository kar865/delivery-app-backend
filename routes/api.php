<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\StoreController;

//Displaying categories,stores and products, with cart routes and search
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{categoryId}/stores', [StoreController::class, 'index']);
    Route::get('/stores/{storeId}/products', [ProductController::class, 'index']);
    Route::get('/stores/{storeId}/products/{productId}', [ProductController::class, 'show']);
    //To show x number of products at the home page
    // Route::get('/home/products', [ProductController::class, 'home']); 

    Route::post('/cart', [CartController::class, 'add']);
    Route::put('/cart/{cartItemId}', [CartController::class, 'update']);
    Route::delete('/cart/{cartItemId}', [CartController::class, 'destroy']);
    Route::get('/cart', [CartController::class, 'index']);

    Route::get('/search', SearchController::class);
});

//Order routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{orderId}', [OrderController::class, 'show']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::delete('/orders/{orderId}', [OrderController::class, 'destroy']);

    Route::get('/orders/{orderId}/items/{itemId}', [OrderItemController::class, 'show']);
    Route::put('/orders/{orderId}/items/{itemId}', [OrderItemController::class, 'update']);
    Route::delete('/orders/{orderId}/items/{itemId}', [OrderItemController::class, 'destroy']);
});

//Favorite routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::post('/favorites', [FavoriteController::class, 'store']);
});


Route::post('/register', [RegisterController::class, 'register']);
Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->middleware('throttle:5,1');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

//An endpoint that returns the IP address of the server 
//to get the current backend IP and use it for subsequent API requests.
// Route::get('/config', function () {
//     return response()->json(['backend_ip' => request()->getHost()]);
// });
