<?php

namespace App\Application\User\UseCases;

use App\Domain\User\Services\UserService;

class DeleteUserUseCase
{
    public function __construct(
        private UserService $userService
    ) {}

    public function execute(int $id): bool
    {
        return $this->userService->delete($id);
    }
}
