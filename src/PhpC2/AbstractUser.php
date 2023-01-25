<?php

namespace App\PhpC2;

use App\PhpC2\Interfaces\AuthInterface;
use App\PhpC2\Interfaces\UserInterface;
use App\PhpC2\Storage\StorageInterface;
use App\PhpC2\Traits\TimestampableTrait;

abstract class AbstractUser implements UserInterface, AuthInterface
{
    use TimestampableTrait {
        setCreatedAt as setTimestampCreatedAt;
    }

    protected ?string $name = null;

    public function __construct(
        protected readonly StorageInterface $storage,
        protected readonly ?string $login = null,
        protected readonly ?string $password = null
    ) {
        $this->storage->set('login', $this->login);
    }

    public function setName(string $name): AbstractUser
    {
        $this->name = $name;

        return $this;
    }

    public function setCreatedAt()
    {
        return __METHOD__;
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
