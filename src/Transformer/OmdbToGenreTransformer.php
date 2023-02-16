<?php

namespace App\Transformer;

use App\Entity\Genre;

class OmdbToGenreTransformer implements \Symfony\Component\Form\DataTransformerInterface
{
    public function transform(mixed $value)
    {
        return (new Genre())->setName($value);
    }

    public function reverseTransform(mixed $value)
    {
        throw new \RuntimeException("Not implemented");
    }
}
