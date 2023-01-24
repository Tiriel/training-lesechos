<?php

namespace App\PhpC2;

abstract class AbstractUser implements UserInterface, AuthInterface
{
    protected ?string $name = null;

    public function __construct(
        protected readonly ?string $login = null,
        protected readonly ?string $password = null
    ) {}

    public function setName(string $name): AbstractUser
    {
        $this->name = $name;

        return $this;
    }

    public function auth(string $login, string $password): bool
    {
        if (!$this->doAuth($login, $password)) {
            throw new \Exception("Authentication failed!");
        }
        
        return true;
    }

    abstract public function doAuth(string $login, string $password): bool;
}
