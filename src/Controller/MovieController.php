<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie')]
class MovieController extends AbstractController
{
    #[Route('', name: 'app_movie_index')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_movie_show')]
    public function show(int $id, MovieRepository $repository): Response
    {
        return $this->render('movie/show.html.twig', [
            'movie' => $repository->find($id),
        ]);
    }

    public function decades(): Response
    {
        $decades = [
            '1980',
        ];

        return $this->render('includes/_decades.html.twig', [
            'decades' => $decades
        ]);
    }
}
