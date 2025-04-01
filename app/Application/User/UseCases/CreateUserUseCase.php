<?php

namespace App\Application\User\UseCases;

use App\Domain\User\DTOs\UserData;
use App\Domain\User\Models\User;
use App\Domain\User\Services\UserService;

class CreateUserUseCase
{
    public function __construct(
        private UserService $userService
    ) {}

    public function execute(array $data): User
    {
        $userData = UserData::fromArray($data);

        return $this->userService->create($userData);
    }
}
