<?php

namespace App\PhpC2\Storage;

class ChainStorage implements StorageInterface
{
    public function __construct(protected readonly array $storages)
    {}

    public function get(string $key): string
    {
        foreach ($this->storages as $storage) {
            /** @var StorageInterface $storage */
            if (($value = $storage->get($key)) !== '') {
                return $value;
            }
        }
        return '';
    }

    public function set(string $key, string $value): bool
    {
        foreach ($this->storages as $storage) {
            try {
                /** @var StorageInterface $storage */
                $storage->set($key, $value);
            } catch (\Exception) {
                return false;
            }
        }

        return true;
    }
}
