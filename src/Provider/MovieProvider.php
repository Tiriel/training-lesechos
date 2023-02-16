<?php

namespace App\Provider;

use App\Consumer\OmdbApiConsumer;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Transformer\OmdbToMovieTransformer;
use Symfony\Component\Console\Style\SymfonyStyle;

class MovieProvider
{
    protected ?SymfonyStyle $io = null;

    public function __construct(
        protected OmdbApiConsumer $consumer,
        protected OmdbToMovieTransformer $transformer,
        protected MovieRepository $repository,
        protected GenreProvider $genreProvider,
    ) {}

    public function setIo(SymfonyStyle $io): void
    {
        $this->io = $io;
    }

    public function getMovieByTitle(string $title): Movie
    {
        return $this->doGet(OmdbApiConsumer::MODE_TITLE, $title);
    }

    public function getMovieById(string $id): Movie
    {
        return $this->doGet(OmdbApiConsumer::MODE_ID, $id);
    }

    private function doGet(string $type, string $value): Movie
    {
        $this->io?->text('Calling OMDb API.');
        $data = $this->consumer->consume($type, $value);

        if ($movie = $this->repository->findOneBy(['title' => $data['Title']])) {
            $this->io?->note('Movie already in database!');
            return $movie;
        }

        $this->io?->text('Saving movie in database');
        $movie = $this->transformer->transform($data);
        foreach ($this->genreProvider->getGenresByString($data['Genre']) as $genre) {
            $movie->addGenre($genre);
        }

        $this->repository->save($movie, true);

        return $movie;
    }
}
