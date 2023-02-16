<?php

namespace App\Transformer;

use App\Entity\Movie;

class OmdbToMovieTransformer implements \Symfony\Component\Form\DataTransformerInterface
{
    public function transform(mixed $value)
    {
        $date = $value['Released'] !== 'N/A' ? $value['Released'] : '01 Jan '. $value['Year'];

        $movie = (new Movie())
            ->setTitle($value['Title'])
            ->setCountry($value['Country'])
            ->setPoster($value['Poster'])
            ->setPlot($value['Plot'])
            ->setReleasedAt(new \DateTimeImmutable($date))
            ->setPrice(500);

        return $movie;
    }

    public function reverseTransform(mixed $value)
    {
        throw new \RuntimeException("Not implemented");
    }
}
