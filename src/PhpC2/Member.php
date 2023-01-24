<?php

namespace App\PhpC2;

class Member extends AbstractUser implements UserInterface, AuthInterface
{
    protected static int $counter = 0;

    public function __construct(
        protected readonly ?string $login = null,
        protected readonly ?string $password = null,
        protected ?int $age = null
    ) {
        ++static::$counter;
    }

    public function __destruct()
    {
        --static::$counter;
    }

    public static function count(): int
    {
        return static::$counter;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function doAuth(string $login, string $password): bool
    {
        return $this->login === $login
            && $this->password === $password;
    }
}
