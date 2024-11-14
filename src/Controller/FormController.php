<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class FormController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        $data = [
            'page_title' => 'Test Page',
            'checked' => false,
            'inputValue' => '',
        ];
        if ($request->isMethod('POST')) {
            $data['usernameValue'] = $request->request->get('username', '');
            $data['title'] = 'Form Sent';
        } else {
            $data['usernameValue'] = 'codeceptUser';
            $data['title'] = 'Test Page';
        }

        return $this->render('dom_crawler/test_page.html.twig', $data);
    }
}
