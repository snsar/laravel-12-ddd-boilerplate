<?php

use App\Interface\Api\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route cho API v1
Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    // User routes
    Route::apiResource('users', UserController::class);

    // Nhóm route theo domain
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        // Route::post('login', [AuthController::class, 'login']);
        // Route::post('register', [AuthController::class, 'register']);
        // Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });

    // Thêm các nhóm route cho các domain khác
    // Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    //     Route::apiResource('', ProductController::class);
    // });
});
