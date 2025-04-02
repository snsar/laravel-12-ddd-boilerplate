<?php

namespace App\Application\User\UseCases;

use App\Domain\User\DTOs\UserData;
use App\Domain\User\Models\User;
use App\Domain\User\Services\UserService;

class UpdateUserUseCase
{
    public function __construct(
        private UserService $userService
    ) {}

    public function execute(int $id, array $data): User
    {
        $userData = UserData::fromArray($data);

        return $this->userService->update($id, $userData);
    }
}
