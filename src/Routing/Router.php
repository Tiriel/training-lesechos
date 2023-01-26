<?php

namespace App\Routing;

use App\Http\Request;

class Router
{
    private array $routes = [];

    public function route(Request $request): Route
    {
        foreach ($this->routes as $route) {
            /** @var Route $route */
            if (!$this->match($request, $route)) {
                continue;
            }

            return $route;
        }

        return new Route('not_found', '', '', '');
    }

    private function match(Request $request, Route $route): bool
    {
        if (preg_match($route->getPath(), $request->getPath())) {
            return true;
        }

        return false;
    }
}
