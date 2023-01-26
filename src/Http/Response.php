<?php

namespace App\Http;

class Response
{
    public function __construct(
        private string $content,
        private string $code,
        private ?array $headers = null
    ) {}

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    public function sendHeaders(): void
    {
        foreach ($this->headers as $name => $header) {
            header("$name: $header");
        }
    }

    public function sendContent(): void
    {
        ob_start();
        echo $this->content;
        ob_get_clean();
    }

    public function send(): void
    {
        $this->sendHeaders();
        $this->sendContent();
    }
}
