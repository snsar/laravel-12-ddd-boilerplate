<?php

namespace App\Domain\User\Actions;

use App\Domain\User\DTOs\UserData;
use App\Domain\User\Models\User;
use App\Domain\User\Services\UserService;

class CreateUserAction
{
    public function __construct(
        private UserService $userService
    ) {}

    public function execute(UserData $userData): User
    {
        return $this->userService->create($userData);
    }
}
