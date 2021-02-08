<?php

declare(strict_types=1);

namespace App\Repository\Model;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function getByEmail(string $email): ?User;
}