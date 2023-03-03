<?php

namespace App\Security\Voter;

use App\Entity\Book;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BookVoter extends Voter
{
    public const CREATE = 'book.create';
    public const READ = 'book.read';
    public const UPDATE = 'book.update';
    public const REMOVE = 'book.remove';

    public function __construct(
        protected readonly AuthorizationCheckerInterface $checker
    ) {}

    protected function supports(string $attribute, mixed $subject): bool
    {
        return \in_array($attribute, [self::CREATE, self::READ, self::UPDATE, self::REMOVE])
            && $subject instanceof Book;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        if ($this->checker->isGranted('ROLE_ADMIN')) {
            return true;
        }

        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        //return \in_array($attribute, $user->getProfile());

        /** @var Book $subject */
        return $subject->getCreatedBy() === $user;
    }
}
