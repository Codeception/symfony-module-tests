<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class FlashController extends AbstractController
{
    public function __invoke(): RedirectResponse
    {
        $this->addFlash('success', 'Welcome back!');

        return $this->redirectToRoute('index');
    }
}
