<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\OrderAdminController;

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    // Products
    Route::get('/products',              [ProductAdminController::class, 'index']);
    Route::get('/products/create',       [ProductAdminController::class, 'create']);
    Route::post('/products',             [ProductAdminController::class, 'store']);
    Route::get('/products/{id}/edit',    [ProductAdminController::class, 'edit']);
    Route::put('/products/{id}',         [ProductAdminController::class, 'update']);
    Route::delete('/products/{id}',      [ProductAdminController::class, 'destroy']);

    // Categories
    Route::get('/categories',            [CategoryAdminController::class, 'index']);
    Route::get('/categories/create',     [CategoryAdminController::class, 'create']);
    Route::post('/categories',           [CategoryAdminController::class, 'store']);
    Route::get('/categories/{id}/edit',  [CategoryAdminController::class, 'edit']);
    Route::put('/categories/{id}',       [CategoryAdminController::class, 'update']);
    Route::delete('/categories/{id}',    [CategoryAdminController::class, 'destroy']);

    // Orders
    Route::get('/orders',             [OrderAdminController::class, 'index']);
    Route::get('/orders/{id}',        [OrderAdminController::class, 'show']);
    Route::put('/orders/{id}/status', [OrderAdminController::class, 'updateStatus']);
});