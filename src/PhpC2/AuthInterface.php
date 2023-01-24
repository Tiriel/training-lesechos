<?php

namespace App\PhpC2;

interface AuthInterface
{
    public function auth(string $login, string $password): bool;
}
