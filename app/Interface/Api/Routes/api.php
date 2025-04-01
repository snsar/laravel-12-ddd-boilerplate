<?php

use App\Interface\Api\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::apiResource('users', UserController::class);
});