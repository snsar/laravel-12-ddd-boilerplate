<?php

namespace App\Infrastructure\User\Repositories;

use App\Domain\User\DTOs\UserData;
use App\Domain\User\Exceptions\UserNotFoundException;
use App\Domain\User\Models\User;
use App\Domain\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository extends UserRepository
{
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function create(UserData $userData): User
    {
        return User::create([
            'name' => $userData->name,
            'email' => (string) $userData->email,
            'password' => Hash::make($userData->password),
        ]);
    }

    public function update(int $id, UserData $userData): ?User
    {
        $user = $this->findById($id);

        if (!$user) {
            throw new UserNotFoundException("User with ID {$id} not found");
        }

        $data = [
            'name' => $userData->name,
            'email' => (string) $userData->email,
        ];

        if ($userData->password) {
            $data['password'] = Hash::make($userData->password);
        }

        $user->update($data);

        return $user;
    }

    public function delete(int $id): bool
    {
        $user = $this->findById($id);

        if (!$user) {
            throw new UserNotFoundException("User with ID {$id} not found");
        }

        return $user->delete();
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
    }
}
