<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\OrderController;

// Categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

// Products
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// Reviews
Route::get('/products/{id}/reviews',  [ReviewController::class, 'index']);
Route::post('/products/{id}/reviews', [ReviewController::class, 'store']);
Route::delete('/reviews/{id}',        [ReviewController::class, 'destroy']);

// Orders
Route::get('/orders',                    [OrderController::class, 'index']);
Route::get('/orders/user/{userId}',      [OrderController::class, 'getByUser']);
Route::get('/orders/{id}',               [OrderController::class, 'show']);
Route::post('/orders',                   [OrderController::class, 'store']);
Route::put('/orders/{id}/status',        [OrderController::class, 'updateStatus']);
