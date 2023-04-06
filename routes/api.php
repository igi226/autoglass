<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Product\ProductController;

// app\Http\Controllers\Api\Auth\AuthController
Route::post('signin', [ AuthController::class, 'signIn']);
Route::post('signup', [ AuthController::class, 'signup']);
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/products', [ProductController::class, 'getProducts']);
});

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ApiController;


// Route::post('register', [ApiController::class, 'register']);
// Route::post('login-api', [ApiController::class, 'loginApi']);
// Route::post('verification', [ApiController::class, 'verification']);

// Route::middleware('auth.basic')->group(function() {
//     Route::get('me', [ApiController::class, 'me']);
//     Route::get('products', [ApiController::class, 'products']);
//     Route::post('products', [ApiController::class, 'search_products']);
//     Route::post('order/request', [ApiController::class, 'request_order']);
//     Route::get('purchases', [ApiController::class, 'get_purchase']);
//     Route::get('purchases/{id}', [ApiController::class, 'purchase_details']);
//     Route::get('order/track/{id}', [ApiController::class, 'track_order']);
//     Route::get('order/confirm/{id}', [ApiController::class, 'confirm_order']);
// });
?>