<?php

namespace App;

use App\Config\Config;
use App\Controller\BaseController;
use App\Http\{Request, RequestStack};
use App\Db\{Connection, Query};
use App\Templating\Templater;
use App\Routing\{Router, UrlGenerator, Route};

class Container
{
    private iterable $services = [];

    public function get(string $className): mixed
    {
        $service = $this->getServiceName($className);

        return $this->$service();
    }

    public function getController(string $controller): BaseController
    {
        $controller = 'App\\Controller\\' . ucfirst($controller) . 'Controller';

        return $this->services[$controller]
            ?? $this->services[$controller] = new $controller($this->AppTemplatingTemplater());
    }

    public static function create(): static
    {
        return new static();
    }

    private function getServiceName(string $className): string
    {
        return str_ireplace('\\', '', $className);
    }

    private function AppHttpRequestStack(): RequestStack
    {
        $name = $this->getServiceName(RequestStack::class);

        return $this->services[$name]
            ?? $this->services[$name] = new RequestStack();
    }

    private function AppRoutingRouter(): Router
    {
        $name = $this->getServiceName(Router::class);

        return $this->services[$name]
            ?? $this->services[$name] = new Router(Config::getRoutes());
    }

    private function AppRoutingUrlGenerator(): UrlGenerator
    {
        $name = $this->getServiceName(UrlGenerator::class);

        return $this->services[$name]
            ?? $this->services[$name] = new UrlGenerator();
    }

    private function AppTemplatingTemplater(): Templater
    {

        $name = $this->getServiceName(Templater::class);

        return $this->services[$name]
            ?? $this->services[$name] = new Templater(Config::getTemplateContext());
    }

    private function AppDbConnection(): Connection
    {
        $name = $this->getServiceName(Connection::class);

        return $this->services[$name]
            ?? $this->services[$name] = new Connection();
    }

    private function AppDbQuery(): Query
    {
        $name = $this->getServiceName(Query::class);

        return $this->services[$name]
            ?? $this->services[$name] = new Query($this->AppDbConnection());
    }
}
