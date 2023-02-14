<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/book/{id<\d+>}', name: 'app_book_delete', methods: ['DELETE'])]
class DeleteBookController
{
    public function __invoke(int $id, Environment $twig): Response
    {
        // Delete book
        
        return new Response($twig->render('book/show.html.twig', [
            'controller_name' => 'Delete book n°'.$id
        ]), 200);
    }
}
