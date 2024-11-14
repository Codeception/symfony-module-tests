<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class DomCrawlerController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('dom_crawler/test_page.html.twig', [
            'page_title' => 'Test Page',
            'title' => 'Test Page',
            'checked' => true,
            'inputValue' => 'Expected Value',
            'usernameValue' => '',
        ]);
    }
}
