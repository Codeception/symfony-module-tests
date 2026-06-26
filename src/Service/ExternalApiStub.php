<?php

declare(strict_types=1);

namespace App\Service;

/**
 * A stand-in for an external API client whose response can be faked at runtime.
 */
final class ExternalApiStub
{
    public const REAL_RESPONSE = 'Real API response';

    private string $response = self::REAL_RESPONSE;

    public function setFakeResponse(string $response): void
    {
        $this->response = $response;
    }

    public function getResponse(): string
    {
        return $this->response;
    }
}
