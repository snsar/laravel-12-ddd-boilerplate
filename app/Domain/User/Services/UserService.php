<?php

namespace App\Domain\User\Services;

use App\Domain\User\DTOs\UserData;
use App\Domain\User\Events\UserCreated;
use App\Domain\User\Events\UserUpdated;
use App\Domain\User\Exceptions\UserNotFoundException;
use App\Domain\User\Models\User;
use App\Domain\User\Repositories\UserRepositoryInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function getById(int $id): ?User
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new UserNotFoundException("User with ID {$id} not found");
        }

        return $user;
    }

    public function create(UserData $userData): User
    {
        $user = $this->userRepository->create($userData);

        event(new UserCreated($user));

        return $user;
    }

    public function update(int $id, UserData $userData): User
    {
        $user = $this->userRepository->update($id, $userData);

        event(new UserUpdated($user));

        return $user;
    }

    public function delete(int $id): bool
    {
        return $this->userRepository->delete($id);
    }

    public function getAll(): array
    {
        return $this->userRepository->getAll();
    }
}
