<?php

namespace App\PhpC2\Interfaces;

interface AuthInterface
{
    public function auth(string $login, string $password): bool;
}
