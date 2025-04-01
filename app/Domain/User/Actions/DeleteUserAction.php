<?php

namespace App\Domain\User\Actions;

use App\Domain\User\Services\UserService;

class DeleteUserAction
{
    public function __construct(
        private UserService $userService
    ) {}

    public function execute(int $id): bool
    {
        return $this->userService->delete($id);
    }
}
