<?php

namespace App\Http;

class Response
{
    public function __construct(
        private string $content,
        private string $code,
        private array $headers = []
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
        echo $this->content;
    }

    public function send(): never
    {
        $this->sendHeaders();
        $this->sendContent();

        if (\function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        } elseif (\PHP_SAPI !== 'cli') {
            ob_get_flush();
        }

        exit(0);
    }
}
