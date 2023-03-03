<?php

namespace App\Controller;

use App\Utils\MyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello/{name<[a-zA-Z- ]+>}', name: 'app_hello', defaults: ['name' => 'World'])]
    public function index(MyService $service, string $sfVersion, string $name = 'World'): Response
    {
        if ($this->isGranted('ROLE_MODERATOR')) {
            $service->dump('Coucou Stéphane');
            $service->dump($sfVersion);
        }

        return $this->render('hello/index.html.twig', [
            'controller_name' => $name,
        ]);
    }
}
