<?php

namespace App\Controller;

use App\Service\Achat\AchatService;
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

    #[Route('/MesAchats', name: 'app_MesAchats')]
    public function MesAchats(UserService $userService, UserInterface $user,
    AchatService $achatService): Response
    {
       $mesAchat = $achatService->getAllAchatByUser($user);

        return $this->render('Achat/mesAchats.html.twig', [
            'controller_name' => 'UserController',
            'mesAchats' => $achatService->getAllAchatByUser($user)

        ]);
    }

    #[Route('/unAchat/{id}', name:'app_unAchat')]
    public function UnAchat(UserService $userService, UserInterface $user,
    AchatService $achatService, $id)
    {
       $achat = $achatService->unAchat($id);
    
        return $this->render('achat/unAchat.html.twig', [
            'controller_name' => 'UserController',
            'unAchat' => $achat

        ]);
    }
}
