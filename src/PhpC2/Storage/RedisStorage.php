<?php

namespace App\PhpC2\Storage;

use App\PhpC2\Redis\Redis;

class RedisStorage implements StorageInterface
{
    public function __construct(
        protected readonly Redis $redis
    ) {}

    public function get(string $key): string
    {
        return $this->redis->fetch($key);
    }

    public function set(string $key, string $value): bool
    {
        $this->redis->insert($key, $value, 3600);
        
        return true;
    }
}
