<?php

namespace App\Application\User\UseCases;

use App\Domain\User\Services\UserService;
use Illuminate\Database\Eloquent\Collection;

class GetAllUsersUseCase
{
    public function __construct(
        private UserService $userService
    ) {}

    public function execute(): Collection
    {
        return $this->userService->getAll();
    }
}
