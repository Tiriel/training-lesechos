<?php

namespace App\Provider;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use App\Transformer\OmdbToGenreTransformer;

class GenreProvider
{
    public function __construct(
        protected OmdbToGenreTransformer $transformer,
        protected GenreRepository $repository
    ) {}

    public function getGenreByName(string $name): Genre
    {
        return $this->repository->findOneBy(['name' => $name])
            ?? $this->transformer->transform($name);
    }

    public function getGenresByString(string $genres): \Generator
    {
        foreach (explode(', ', $genres) as $genre) {
            yield $this->getGenreByName($genre);
        }
    }
}
