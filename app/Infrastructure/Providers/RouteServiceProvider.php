<?php

namespace App\Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        // Định nghĩa các ràng buộc route
        Route::pattern('id', '[0-9]+');

        // Thêm route middleware macros nếu cần
    }

    /**
     * Đăng ký dịch vụ.
     */
    public function register(): void
    {
        // Đăng ký các dịch vụ liên quan đến route
    }
}
