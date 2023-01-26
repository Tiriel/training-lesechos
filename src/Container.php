<?php

namespace App;

use App\Controller\BaseController;
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

    private function getServiceName(string $className): string
    {
        return strtr($className, '\\', '');
    }
    private function AppRoutingRouter(): Router
    {
        $name = $this->getServiceName(Router::class);

        return $this->services[$name]
            ?? $this->services[$name] = new Router(Config\ROUTES);
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
            ?? $this->services[$name] = new Templater();
    }

    public function getController(string $className): BaseController
    {
        return $this->services[$className]
            ?? $this->services[$className] = new $className($this->AppTemplatingTemplater());
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

    public static function create(): static
    {
        return new static();
    }
}
