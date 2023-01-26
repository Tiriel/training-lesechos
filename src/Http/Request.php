<?php

namespace App\Http;

class Request
{
    private string $path = '';
    private string $method = '';
    public function __construct(
        public array $get = [],
        public array $post = [],
        public array $server = []
    ) {}

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public static function create(): static
    {
        return new static($_GET, $_POST, $_SERVER);
    }
}
