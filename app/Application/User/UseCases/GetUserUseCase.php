<?php

namespace App\Application\User\UseCases;

use App\Domain\User\Models\User;
use App\Domain\User\Services\UserService;

class GetUserUseCase
{
    public function __construct(
        private UserService $userService
    ) {}

    public function execute(int $id): User
    {
        return $this->userService->getById($id);
    }
}
