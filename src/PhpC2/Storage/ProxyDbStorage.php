<?php

namespace App\PhpC2\Storage;

class ProxyDbStorage implements StorageInterface
{
    protected array $cache = [];
    public function __construct(protected readonly DbStorage $storage)
    {
    }

    public function get(string $key): string
    {
        return array_key_exists($key, $this->cache)
            ? $this->cache[$key]
            : $this->cache[$key] = $this->storage->get($key);
    }

    public function set(string $key, string $value): bool
    {
        return $this->storage->set($key, $value);
    }
}
