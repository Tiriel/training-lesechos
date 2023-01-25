<?php

namespace App\PhpC2\Storage;

class DbStorage implements StorageInterface
{
    public function __construct(protected readonly object $connection)
    {
    }

    public function get(string $key): string
    {
        return $this->connection->select($key);
    }

    public function set(string $key, string $value): bool
    {
        try {
            $this->connection->insert($key, $value);
            return true;
        } catch (\Exception) {
            return false;
        }
    }
}
