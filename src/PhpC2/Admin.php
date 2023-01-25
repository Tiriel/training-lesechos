<?php

namespace App\PhpC2;

use App\PhpC2\Enums\AdminLevelEnum;

class Admin extends Member
{
    public function __construct(
        protected readonly ?string $login = null,
        protected readonly ?string $password = null,
        protected ?int $age = null,
        protected readonly AdminLevelEnum $level = AdminLevelEnum::ADMIN
    ) {
    }

    public function auth(string $login, string $password, ?string $level = null): bool
    {
        if ($this->level === AdminLevelEnum::tryFrom($level)) {
            return true;
        }

        return parent::auth($login, $password);
    }
}
