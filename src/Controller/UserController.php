<?php

namespace App\Controller;

use App\Service\User\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(UserService $userService, UserInterface $user): Response
    {
        
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'carte' => $userService->getCarteFidélité($user)
        ]);
    }

    #[Route('/add_carte', name: 'add_carte')]
    public function AddCarte(UserService $userService, UserInterface $user): Response
    {
        $userService->addCarteFidélité($user);

        return $this->redirectToRoute('app_profile');
    }
}
