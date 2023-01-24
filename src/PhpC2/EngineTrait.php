<?php

namespace App\PhpC2;

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
