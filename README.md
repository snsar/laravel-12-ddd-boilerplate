# Laravel 12 DDD Boilerplate

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Giới thiệu

Đây là một boilerplate (mẫu khởi đầu) cho Laravel 12 được xây dựng theo kiến trúc Domain-Driven Design (DDD). Boilerplate này cung cấp cấu trúc cơ bản để phát triển ứng dụng Laravel tuân theo các nguyên tắc của DDD, giúp tổ chức mã nguồn theo cách rõ ràng và dễ bảo trì hơn.

## Cấu trúc thư mục

Boilerplate tuân theo cấu trúc DDD với các thành phần chính:

- **Domain**: Chứa các đối tượng domain, entities, value objects, domain events và domain services
- **Application**: Chứa application services, command/query handlers và DTOs
- **Infrastructure**: Triển khai cơ sở hạ tầng kỹ thuật như repositories, adapters cho bên ngoài
- **Interface**: Chứa các controllers, console commands, API endpoints và giao diện người dùng

## Tính năng

- Cấu trúc theo Domain-Driven Design
- Laravel 12 với tất cả tính năng mới nhất
- Tích hợp sẵn các công cụ phát triển
- Tổ chức mã nguồn rõ ràng, dễ mở rộng
- Được thiết kế để dễ dàng áp dụng các nguyên tắc SOLID

## Yêu cầu

- PHP >= 8.2
- Composer
- Database (MySQL, PostgreSQL, SQLite)

## Cài đặt

1. Clone repository:
```bash
git clone [repository-url]
cd laravel-ddd
```

2. Cài đặt dependencies:
```bash
composer install
```

3. Tạo file môi trường:
```bash
cp .env.example .env
```

4. Tạo application key:
```bash
php artisan key:generate
```

5. Cấu hình database trong file .env

6. Chạy migrations:
```bash
php artisan migrate
```

## Sử dụng

Dự án này tuân theo cấu trúc DDD, vì vậy khi xây dựng tính năng mới, bạn nên:

1. Xác định domain entities và value objects
2. Thực hiện business logic trong domain services
3. Tạo application services để phối hợp các domain services
4. Xây dựng giao diện người dùng trong Interface layer

## Giấy phép

Phần mềm mã nguồn mở được cấp phép theo [giấy phép MIT](https://opensource.org/licenses/MIT).
