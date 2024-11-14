<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class BrowserController extends AbstractController
{
    public function requestWithAttribute(Request $request): Response
    {
        $request->attributes->set('page', 'register');

        return $this->render('blog/home.html.twig');
    }

    public function responseWithCookie(): Response
    {
        $response = new Response('TESTCOOKIE has been set.');
        $response->headers->setCookie(new Cookie('TESTCOOKIE', 'codecept'));

        return $response;
    }

    public function responseJsonFormat(): Response
    {
        return $this->json([
            'status' => 'success',
            'message' => "Expected format: 'json'.",
        ]);
    }

    public function unprocessableEntity(): Response
    {
        return $this->json([
            'status' => 'error',
            'message' => 'The request was well-formed but could not be processed.',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function redirectToHome(): RedirectResponse
    {
        return $this->redirectToRoute('index');
    }
}
