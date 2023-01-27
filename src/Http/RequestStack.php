<?php

namespace App\Http;

use App\Http\Enum\RequestTypesEnum;

class RequestStack implements \Countable, \ArrayAccess
{
    private int $pos = 0;
    private \SplStack $data;
    private \SplObjectStorage $map;

    public function __construct()
    {
        $this->data = new \SplStack();
        $this->map = new \SplObjectStorage();
    }

    public function push(Request $request): void
    {
        if (!$this->map->contains($request)) {
            $this[] = $request;
        }
    }
    public function contains(Request $request): bool
    {
        return $this->map->contains($request);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->data[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$this->map->contains($value)) {
            $type = $this->data->count() === 0
                ? RequestTypesEnum::REQUEST_TYPE_MAIN
                : RequestTypesEnum::REQUEST_TYPE_SUB;
            $this->map->attach($value, $type);

            if (null === $offset) {
                $this->data[] = $value;
            } else {
                $this->data[$offset] = $value;
            }
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->map->offsetUnset($offset);
    }

    public function count(): int
    {
        return $this->data->count();
    }
}
