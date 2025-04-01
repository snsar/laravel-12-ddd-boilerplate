<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../app/Interface/Web/Routes/web.php',
        api: __DIR__ . '/../app/Interface/Api/Routes/api.php',
        commands: __DIR__ . '/../app/Interface/Console/Routes/command.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Thêm middleware global nếu cần
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Cấu hình xử lý ngoại lệ
    })->create();
