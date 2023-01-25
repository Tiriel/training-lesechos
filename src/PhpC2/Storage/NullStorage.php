<?php

namespace App\PhpC2\Storage;

class NullStorage implements StorageInterface
{
    protected array $session = [];

    public function get(string $key): string
    {
        return $this->session[$key] ?? '';
    }

    public function set(string $key, string $value): bool
    {
        $this->session[$key] = $value;

        return true;
    }
}
