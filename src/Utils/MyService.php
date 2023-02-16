<?php

namespace App\Utils;

use Doctrine\ORM\EntityManagerInterface;

class MyService
{
    public function __construct(
        protected EntityManagerInterface $manager,
        protected int $numberPerPage
    ) {}

    public function dump(string $string): void
    {
        dump($string);
    }
}
