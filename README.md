# Laravel 12 DDD Boilerplate

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Giới thiệu

Đây là một boilerplate (mẫu khởi đầu) cho Laravel 12 được xây dựng theo kiến trúc Domain-Driven Design (DDD). Boilerplate này cung cấp cấu trúc cơ bản để phát triển ứng dụng Laravel tuân theo các nguyên tắc của DDD, giúp tổ chức mã nguồn theo cách rõ ràng và dễ bảo trì hơn.

## Kiến trúc DDD

Boilerplate này tuân theo các nguyên tắc của Domain-Driven Design với cấu trúc phân tầng rõ ràng:

### Domain Layer
- **Trung tâm của ứng dụng**, chứa tất cả business logic
- **Không phụ thuộc vào các layer khác** (không import từ Application/Infrastructure)
- Chứa:
  - **Models**: Entities core của domain
  - **Repositories (Interfaces + Abstract)**: Định nghĩa contract cho data access
  - **Services**: Business logic dành riêng cho domain
  - **Events & Listeners**: Xử lý các sự kiện domain
  - **ValueObjects**: Các đối tượng immutable không có ID
  - **DTOs**: Data Transfer Objects
  - **Exceptions**: Exceptions dành riêng cho domain

### Application Layer 
- Điều phối các use cases giữa người dùng và domain
- Chứa:
  - **UseCases/Actions**: Implement các use cases cụ thể
  - **Services**: Điều phối nhiều domain services và entities

### Infrastructure Layer
- Chứa code để giao tiếp với thế giới bên ngoài và các third-party services
- Chứa:
  - **Repository Implementations**: Triển khai cụ thể của repositories
  - **External Services**: Adapters cho các dịch vụ bên ngoài
  - **Providers**: Service providers của Laravel

### Interface Layer
- Chứa tất cả các giao diện giao tiếp với bên ngoài:
  - **Web Controllers**
  - **API Controllers**
  - **Console Commands**
  - **Views/Templates**

## Cấu trúc thư mục

```
app/
├── Domain/                 # Domain layer
│   ├── Entity/             # Mỗi entity có thư mục riêng
│   │   ├── Models/         # Entities
│   │   ├── Repositories/   # Repository interfaces & abstract
│   │   ├── Services/       # Domain services
│   │   ├── DTOs/           # Data Transfer Objects
│   │   ├── Events/         # Domain events
│   │   ├── Listeners/      # Domain event listeners
│   │   ├── ValueObjects/   # Value objects
│   │   ├── Exceptions/     # Domain exceptions
│   │   └── Actions/        # Domain actions
│   │
│   └── Shared/             # Shared domain components
│
├── Application/            # Application layer
│   └── Entity/             # Use cases cho từng entity
│
├── Infrastructure/         # Infrastructure layer
│   ├── Entity/             # Infrastructure cho từng entity
│   │   └── Repositories/   # Repository implementations
│   │
│   └── Providers/          # Service providers
│
└── Interface/              # Interface layer
    ├── Web/                # Web interface
    ├── Api/                # API interface
    └── Console/            # Console commands
```

## Command `make:entity`

Để thuận tiện trong phát triển, boilerplate cung cấp lệnh Artisan `make:entity` để tự động tạo cấu trúc cho một entity mới:

```bash
php artisan make:entity TenEntity
```

Lệnh này sẽ tạo tự động:

1. Cấu trúc thư mục đầy đủ cho entity mới
2. Model cơ bản
3. DTO cơ bản
4. Repository interface và abstract class trong Domain layer
5. Eloquent repository implementation trong Infrastructure layer
6. Service cơ bản

## Các nguyên tắc thiết kế

Boilerplate này tuân theo các nguyên tắc thiết kế sau:

1. **Dependency Inversion**: Domain layer không phụ thuộc vào các layer khác
2. **Separation of Concerns**: Tách biệt rõ ràng các trách nhiệm
3. **Ubiquitous Language**: Sử dụng ngôn ngữ thống nhất trong code
4. **SOLID Principles**: Áp dụng 5 nguyên tắc SOLID

## Cài đặt và sử dụng

### Yêu cầu
- PHP >= 8.2
- Composer
- Database (MySQL, PostgreSQL, SQLite)

### Cài đặt

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

### Phát triển mới

Khi cần tạo một tính năng/entity mới:

1. Tạo cấu trúc cơ bản:
```bash
php artisan make:entity TenEntity
```

2. Định nghĩa các thuộc tính và mối quan hệ cho Model trong `app/Domain/TenEntity/Models/TenEntity.php`

3. Cập nhật DTO trong `app/Domain/TenEntity/DTOs/TenEntityDTO.php`

4. Đăng ký binding repository trong `app/Infrastructure/Providers/RepositoryServiceProvider.php`:
```php
$this->app->bind(
    \App\Domain\TenEntity\Repositories\TenEntityRepositoryInterface::class,
    \App\Infrastructure\TenEntity\Repositories\EloquentTenEntityRepository::class
);
```

5. Tạo migrations cho entity mới:
```bash
php artisan make:migration create_ten_entity_table
```

## Giấy phép

Phần mềm mã nguồn mở được cấp phép theo [giấy phép MIT](https://opensource.org/licenses/MIT).
