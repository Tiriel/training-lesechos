<?php

namespace App\Routing;

class Route
{
    public function __construct(
        private readonly string $name,
        private readonly string $path,
        private readonly string $controller,
        private readonly string $action,
        private readonly ?array $args = null
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getArgs(): ?array
    {
        return $this->args;
    }
}
