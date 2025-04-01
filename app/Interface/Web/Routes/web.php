<?php

use Illuminate\Support\Facades\Route;

// Trang chủ
Route::get('/', function () {
    return 'Hello World';
    // return view('welcome');
})->name('home');

// Nhóm route cho người dùng - dùng resource controller khi cần
// Route::resource('users', UserController::class);

// Có thể phân nhóm route theo domain
// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
//     // Các route cho admin
// });
