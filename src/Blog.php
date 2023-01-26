<?php

namespace App;

use App\Http\Request;
use App\Http\Response;
use App\Routing\Router;

class Blog
{
    private readonly Container $container;

    public function __construct()
    {
        $this->container = Container::create();
    }

    public function handle(Request $request): Response
    {
        $route = $this->container->get(Router::class)->route($request);

        if ('' === $controller = $route ->getController()) {
            return new Response('', 404);
        }
        $action = $route->getAction();

        return $controller->$action($request, ...$route->getArgs());
    }
}
