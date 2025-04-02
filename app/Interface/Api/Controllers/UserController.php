<?php

namespace App\Interface\Api\Controllers;

use App\Application\User\Requests\CreateUserRequest;
use App\Application\User\Requests\UpdateUserRequest;
use App\Application\User\Resources\UserResource;
use App\Application\User\UseCases\CreateUserUseCase;
use App\Application\User\UseCases\DeleteUserUseCase;
use App\Application\User\UseCases\GetAllUsersUseCase;
use App\Application\User\UseCases\GetUserUseCase;
use App\Application\User\UseCases\UpdateUserUseCase;
use App\Domain\User\Exceptions\UserNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController
{
    public function __construct(
        private CreateUserUseCase $createUserUseCase,
        private GetUserUseCase $getUserUseCase,
        private UpdateUserUseCase $updateUserUseCase,
        private GetAllUsersUseCase $getAllUsersUseCase,
        private DeleteUserUseCase $deleteUserUseCase
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $users = $this->getAllUsersUseCase->execute();

        return UserResource::collection($users);
    }

    public function show(int $id): UserResource
    {
        try {
            $user = $this->getUserUseCase->execute($id);

            return new UserResource($user);
        } catch (UserNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = $this->createUserUseCase->execute($request->validated());

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateUserRequest $request, int $id): UserResource
    {
        try {
            $user = $this->updateUserUseCase->execute($id, $request->validated());

            return new UserResource($user);
        } catch (UserNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->deleteUserUseCase->execute($id);

            return response()->json(null, 204);
        } catch (UserNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }
}
