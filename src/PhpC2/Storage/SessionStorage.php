<?php

namespace App\PhpC2\Storage;

class SessionStorage implements StorageInterface
{

    public function get(string $key): string
    {
        return $_SESSION[$key] ?? '';
    }

    public function set(string $key, string $value): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
            session_name('my_session');
        }

        try {
            $_SESSION[$key] = $value;
            return true;
        } catch (\Exception) {
            return false;
        }
    }
}
