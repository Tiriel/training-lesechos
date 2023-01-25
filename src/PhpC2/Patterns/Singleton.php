<?php

namespace App\PhpC2\Patterns;

class Singleton
{
    protected static $instance = null;
    private function __construct(){}
    private function __clone() {}

    public static function create(): Singleton
    {
        return static::$instance ?? static::$instance = new static();
    }
}
