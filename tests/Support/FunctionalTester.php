<?php

declare(strict_types=1);

namespace App\Tests\Support;

use Codeception\Actor;

class FunctionalTester extends Actor
{
    use _generated\FunctionalTesterActions;

    public function registerUser(string $email, string $password, bool $followRedirects): void
    {
        $this->amOnPage('/register');
        if (!$followRedirects) {
            $this->stopFollowingRedirects();
        }
        $this->submitSymfonyForm('registration_form', [
            '[email]' => $email,
            '[password]' => $password,
            '[agreeTerms]' => true,
        ]);
    }
}
