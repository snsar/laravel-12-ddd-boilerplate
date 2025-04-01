<?php

namespace App\Domain\User\DTOs;

use App\Domain\User\ValueObjects\Email;

class UserData
{
    public function __construct(
        public readonly string $name,
        public readonly Email $email,
        public readonly ?string $password = null,
        public readonly ?int $id = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: new Email($data['email']),
            password: $data['password'] ?? null,
            id: $data['id'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => (string) $this->email,
        ];
    }
}
