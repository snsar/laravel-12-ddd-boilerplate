<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\DTOs\UserData;
use App\Domain\User\Models\User;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function create(UserData $userData): User;

    public function update(int $id, UserData $userData): ?User;

    public function delete(int $id): bool;

    public function getAll(): array;
}
