<?php

namespace App\Routing;

class PathUtils
{
    public static function splitName(string $name): array
    {
        return explode('_', $name, 2);
    }

    public static function pascalizeName(string $name): string
    {
        return array_reduce(static::splitName($name), fn($carry, $part) => $carry . ucfirst($part));
    }
}
