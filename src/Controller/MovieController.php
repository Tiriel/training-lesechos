<?php

namespace App\Controller;

use App\Payment\PaymentFactory;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie')]
class MovieController extends AbstractController
{
    #[Route('', name: 'app_movie_index')]
    public function index(MovieRepository $repository): Response
    {
        return $this->render('movie/index.html.twig', [
            'movies' => $repository->findAll(),
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_movie_show')]
    public function show(int $id, MovieRepository $repository): Response
    {
        return $this->render('movie/show.html.twig', [
            'movie' => $repository->find($id),
        ]);
    }

    #[Route('/payment/{paymentType}', name: 'app_movie_payment', methods: ['GET'])]
    public function payment(string $paymentType, PaymentFactory $factory): Response
    {
        $paid = $factory->pay($paymentType);

        return $this->render('movie/payment.html.twig', [
            'paid' => $paid,
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
