<?php

namespace App\PhpC2\Traits;

trait EngineTrait
{
    public function start(): bool
    {
        if (!$this->started) {
            $this->started = true;
        }

        return $this->started;
    }
}
