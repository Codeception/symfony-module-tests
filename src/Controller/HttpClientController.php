<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class HttpClientController extends AbstractController
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function routeUsingHttpClient(): Response
    {
        $internalUrl = $this->generateUrl('internal_endpoint', [], UrlGeneratorInterface::ABSOLUTE_URL);

        $response = $this->httpClient->request('GET', $internalUrl, [
            'headers' => ['Accept' => 'application/json'],
        ]);

        return new Response("Internal request completed successfully: {$response->getStatusCode()}");
    }

    public function internalEndpoint(): Response
    {
        return $this->json(['message' => 'Response from internal endpoint.']);
    }

    public function routeMakingMultipleRequests(): Response
    {
        $internalUrl = $this->generateUrl('internal_endpoint', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $internalUrlPost = $this->generateUrl('internal_endpoint_post', [], UrlGeneratorInterface::ABSOLUTE_URL);

        $response1 = $this->httpClient->request('GET', $internalUrl, [
            'headers' => ['Accept' => 'application/json'],
        ]);

        $response2 = $this->httpClient->request('POST', $internalUrlPost, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => ['key' => 'value'],
        ]);

        $response3 = $this->httpClient->request('GET', $internalUrl, [
            'headers' => ['Accept' => 'application/json'],
        ]);

        $message = sprintf(
            "Request 1: %d\nRequest 2: %d\nRequest 3: %d",
            $response1->getStatusCode(),
            $response2->getStatusCode(),
            $response3->getStatusCode()
        );

        return new Response($message);
    }

    public function internalEndpointPost(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        return $this->json(['received' => $data]);
    }

    public function routeShouldNotMakeSpecificRequest(): Response
    {
        return new Response('No specific internal requests were made.');
    }

    public function internalEndpointNotDesired(): Response
    {
        return $this->json(['message' => 'This endpoint should not be called.']);
    }
}
