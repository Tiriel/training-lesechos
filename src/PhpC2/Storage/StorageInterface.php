<?php

namespace App\PhpC2\Storage;

interface StorageInterface
{
    public function get(string $key): string;

    public function set(string $key, string $value): bool;
}
