<?php

namespace App\PhpC2;

class Vehicle
{
    public function __construct(
        protected bool $started = false,
        protected VehicleTypeEnum $type = VehicleTypeEnum::GENERIC
    ) {}

    public function start(): bool
    {
        if (!$this->started) {
            $this->started = true;
        }

        return $this->started;
    }
}
