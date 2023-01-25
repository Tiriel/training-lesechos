<?php

namespace App\PhpC2\Traits;

trait EngineTrait
{
    protected bool $started = false;

    public function start(): bool
    {
        if (!$this->started) {
            $this->started = true;
        }

        return $this->started;
    }
}
