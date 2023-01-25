<?php

namespace App\PhpC2\Interfaces;

interface UserInterface
{
    public function getLogin(): string;

    public function getPassword(): string;
}
