<?php

declare(strict_types=1);

namespace App\Tests\Support;

use Codeception\Actor;

class FunctionalTester extends Actor
{
    use _generated\FunctionalTesterActions;

    public function amApiAuthenticated(): void
    {
        $this->haveHttpHeader('content-type', 'application/json');
        $this->sendPost('/api/login', [
            'username' => 'john_doe@gmail.com',
            'password' => '123456',
        ]);
        $token = $this->grabDataFromResponseByJsonPath('$.token')[0];

        $this->amBearerAuthenticated($token);
    }

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
