<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Validator\Constraints\NotNull;

#[ApiResource]
class Book
{
    #[NotNull]
    public string $name;
}
