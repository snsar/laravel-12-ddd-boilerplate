<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\DTOs\UserData;
use App\Domain\User\Models\User;

/**
 * Abstract repository class that defines the contract
 * This keeps the domain layer independent from infrastructure details
 */
abstract class UserRepository implements UserRepositoryInterface
{
    abstract public function findById(int $id): ?User;
    abstract public function findByEmail(string $email): ?User;
    abstract public function create(UserData $userData): User;
    abstract public function update(int $id, UserData $userData): ?User;
    abstract public function delete(int $id): bool;
    abstract public function getAll(): \Illuminate\Database\Eloquent\Collection;
}
