<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractInertiaController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        /** @var ?User $currentUser */
        $currentUser = $this->getUser();

        if (null !== $currentUser) {
            return $this->redirectToRoute('app_dashboard');
        }

        return $this->renderWithInertia('Auth/Login');
    }
}
