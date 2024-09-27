<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class HttpClientCest
{
    public function assertHttpClientRequest(FunctionalTester $I)
    {
        $I->sendAjaxRequest('GET', '/route-using-http-client');

        $expectedUrl = $I->grabService('router')->generate(
            'internal_endpoint',
            [],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        $I->assertHttpClientRequest(
            $expectedUrl,
            'GET',
            null,
            ['Accept' => 'application/json']
        );
    }

    public function assertHttpClientRequestCount(FunctionalTester $I)
    {
        $I->sendAjaxRequest('GET', '/route-making-multiple-requests');

        $I->assertHttpClientRequestCount(3);
    }

    public function assertNotHttpClientRequest(FunctionalTester $I)
    {
        $I->sendAjaxRequest('GET', '/route-should-not-make-specific-request');

        $I->assertNotHttpClientRequest('/internal-endpoint-not-desired', 'GET');
    }
}
