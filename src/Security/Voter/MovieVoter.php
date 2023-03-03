<?php

namespace App\Security\Voter;

use App\Entity\Movie;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class MovieVoter extends Voter
{
    public const REMOVE = 'movie.remove';
    public const EDIT = 'movie.edit';
    public const VIEW = 'movie.view';

    public const OPERATIONS = [
        self::VIEW,
        self::EDIT,
        self::REMOVE,
    ];

    public function __construct(
        protected readonly AuthorizationCheckerInterface $checker
    ) {}

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, self::OPERATIONS)
            && $subject instanceof Movie;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        if ($this->checker->isGranted('ROLE_ADMIN')) {
            return true;
        }

        return match ($attribute) {
            self::VIEW => $this->checkView($token, $subject),
            self::EDIT, self::REMOVE => $this->checkEditOrRemove($token, $subject),
            default => false,
        };
    }

    protected function checkView(TokenInterface $token, Movie $movie): bool
    {
        if ($movie->getRated() === 'G') {
            return true;
        }

        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        $age = $user->getBirthday()?->diff(new \DateTimeImmutable())->y ?? null;

        return match ($movie->getRated()) {
            'PG', 'PG-13' => $age && $age >= 13,
            'R', 'NC-17' => $age && $age >= 17,
            default => false,
        };
    }

    protected function checkEditOrRemove(TokenInterface $token, Movie $movie): bool
    {
        return $this->checkView($token, $movie)
            && $token->getUser() === $movie->getCreatedBy();
    }
}
