<?php

namespace App\Provider;

use App\Consumer\OmdbApiConsumer;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Transformer\OmdbToMovieTransformer;

class MovieProvider
{
    public function __construct(
        protected OmdbApiConsumer $consumer,
        protected OmdbToMovieTransformer $transformer,
        protected MovieRepository $repository,
        protected GenreProvider $genreProvider,
    ) {}

    public function getMovieByTitle(string $title): Movie
    {
        $data = $this->consumer->consume(OmdbApiConsumer::MODE_TITLE, $title);

        if ($movie = $this->repository->findOneBy(['title' => $data['Title']])) {
            return $movie;
        }

        $movie = $this->transformer->transform($data);
        foreach ($this->genreProvider->getGenresByString($data['Genre']) as $genre) {
            $movie->addGenre($genre);
        }

        $this->repository->save($movie, true);

        return $movie;
    }
}
