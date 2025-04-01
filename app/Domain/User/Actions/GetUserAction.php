<?php

namespace App\Domain\User\Actions;

use App\Domain\User\Models\User;
use App\Domain\User\Services\UserService;

class GetUserAction
{
    public function __construct(
        private UserService $userService
    ) {}

    public function execute(int $id): User
    {
        return $this->userService->getById($id);
    }

    public function getAll(): array
    {
        return $this->userService->getAll();
    }
}
