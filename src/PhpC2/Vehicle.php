<?php

namespace App\PhpC2;

use App\PhpC2\Enums\VehicleTypeEnum;

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
