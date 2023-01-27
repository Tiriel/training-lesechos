<?php

namespace App\Controller;

use App\Http\Response;
use App\Templating\Templater;

abstract class BaseController
{
    public function __construct(
        protected readonly Templater $templater
    ) {}

    protected function render(string $viewName, iterable $context = [], int $statusCode = 200): Response
    {
        return new Response(
            $this->templater->render($viewName, $context),
            $statusCode
        );
    }
}
