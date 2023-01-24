<?php

namespace App\PhpC2;

interface UserInterface
{
    public function getLogin(): string;

    public function getPassword(): string;
}
