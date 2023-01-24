<?php

namespace App\PhpC2;

class BackofficeUser implements UserInterface
{
    public function __construct(
        private readonly ?string $login = null,
        private readonly ?string $password = null
    ) {}

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
