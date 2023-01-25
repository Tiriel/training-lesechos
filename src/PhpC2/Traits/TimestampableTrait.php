<?php

namespace App\PhpC2\Traits;

trait TimestampableTrait
{
    protected ?\DateTimeImmutable $createdAt = null;

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): TimestampableTrait
    {
        $this->createdAt = $createdAt;
        return $this;
    }


}
