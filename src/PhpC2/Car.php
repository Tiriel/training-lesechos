<?php

namespace App\PhpC2;

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
function checkUser(UserInterface $user) {
    $login = $user->getLogin();
}
