<?php

namespace App;

use App\Http\Request;
use App\Http\RequestStack;
use App\Http\Response;
use App\Routing\Route;
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
        $router = $this->container->get(Router::class);
        $this->container->get(RequestStack::class)->push($request);

        /** @var Route $route */
        $route = $router->route($request);
        if ('' === $controller = $route->getController()) {
            return new Response('', 404);
        }

        $controller = $this->container->getController($controller);
        $action = $route->getAction();

        return $controller->$action(...$request->getAttributes());
    }
}
