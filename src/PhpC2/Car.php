<?php

namespace App\PhpC2;

use App\PhpC2\Enums\VehicleTypeEnum;
use App\PhpC2\ErrorHandler\StorageErrorHandler;
use App\PhpC2\Interfaces\UserInterface;
use App\PhpC2\Patterns\ProxyMember;
use App\PhpC2\Redis\Redis;
use App\PhpC2\Storage\ChainStorage;
use App\PhpC2\Storage\DbStorage;
use App\PhpC2\Storage\NullStorage;
use App\PhpC2\Storage\RedisStorage;
use App\PhpC2\Storage\SessionStorage;
use App\PhpC2\Traits\EngineTrait;

class Car extends Vehicle
{
    use EngineTrait {
        start as startEngine;
    }
    public function __construct(bool $started = false)
    {
        parent::__construct(false, VehicleTypeEnum::CAR);
    }

    public function start($foo = true): bool
    {
        return true;
    }

    public function run(): void
    {

    }
}

function foo(Vehicle $vehicle) {
    $vehicle->start();
    $vehicle->run();
}


foo(new Car());
$car = new Car();
$car->startEngine();
$storage = new ChainStorage([new SessionStorage(), new RedisStorage(new Redis()), new NullStorage()]);
$member = new ProxyMember(new Member($storage));

$dbStorage = new DbStorage(new class{
    public function select(): string {
        return '';
    }
});

$dbStorage->get('foo');

$storage->get('foo');
function checkUser(UserInterface $user) {
    $login = $user->getLogin();
}

set_error_handler(new StorageErrorHandler($dbStorage));
