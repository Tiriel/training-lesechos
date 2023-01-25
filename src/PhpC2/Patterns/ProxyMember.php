<?php

namespace App\PhpC2\Patterns;

use App\PhpC2\AbstractUser;
use App\PhpC2\Interfaces\AuthInterface;
use App\PhpC2\Interfaces\UserInterface;
use App\PhpC2\Storage\StorageInterface;

class ProxyMember extends AbstractUser
{
    protected ?bool $auth = null;

    public function __construct(protected readonly AbstractUser $user)
    {}

    public function getLogin(): string
    {
        return $this->user->getLogin();
    }

    public function getPassword(): string
    {
        return $this->user->getPassword();
    }

    public function auth(string $login, string $password): bool
    {
        return $this->auth ?? $this->auth = $this->user->auth($login, $password);
    }

    public function doAuth(string $login, string $password): bool
    {
        return $this->auth;
    }
}
