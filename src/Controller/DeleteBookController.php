<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Security\Voter\BookVoter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Twig\Environment;

#[Route('/book/{id<\d+>}', name: 'app_book_delete', methods: ['DELETE'])]
class DeleteBookController
{
    public function __construct(
        protected readonly Environment $twig,
        protected readonly BookRepository $repository,
        protected readonly AuthorizationCheckerInterface $checker
    ) {}

    public function __invoke(int $id): Response
    {
        $book = $this->repository->find($id);
        if (!$this->checker->isGranted(BookVoter::REMOVE, $book)) {
            throw new AccessDeniedException();
        }

        $this->repository->remove($book, true);

        return new Response($this->twig->render('book/show.html.twig', [
            'controller_name' => 'Delete book n°'.$id
        ]), 200);
    }
}
