<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Event\UserRegisteredEvent;
use App\Form\RegistrationFormType;
use App\Repository\Model\UserRepositoryInterface;
use App\Utils\Mailer;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class RegistrationController extends AbstractController
{
    private Mailer $mailer;

    private UserRepositoryInterface $userRepository;

    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        Mailer $mailer,
        UserRepositoryInterface $userRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            $user->setPassword($plainPassword);

            $this->userRepository->save($user);

            $this->mailer->sendConfirmationEmail($user);

            $this->eventDispatcher->dispatch(new UserRegisteredEvent());

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
