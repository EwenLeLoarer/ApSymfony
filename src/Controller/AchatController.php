<?php

namespace App\Controller;

use App\Entity\Achat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;
use App\Repository\ArticleRepository;
use App\Service\Cart\CartService;
use App\Service\User\UserService;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Persistence\ManagerRegistry;

class AchatController extends AbstractController
{
    #[Route('/panier', name: 'cart_index')]
    public function index(SessionInterface $session,CartService $cartService, UserInterface $user
    ,UserService $userService): Response
    {
        $panier = $session->get('panier', []);
        
        
       $panierAvecData = $cartService->getFullCart();
       $total = 0;

        foreach($panierAvecData as $item){
            $totalItem = $item['article']->getPrixArticle() * $item['quantity'];
            $total += $totalItem;
        }

        $totalPoints = $cartService->getTotalPoints();



        return $this->render('achat/index.html.twig', [
            'controller_name' => 'AchatController',
            'items' => $panierAvecData,
            'totalItem' => $total,
            'totalPoints' => $totalPoints,
            'carte' => $userService->getCarteFidélité($user)

        ]);
    }

    #[Route('/panier/add/{id}', name: 'cart_add')]
    public function add($id, CartService $cartService){
        $cartService->add($id);
        return $this->redirectToRoute("cart_index");  
    }

    #[Route('/panier/remove/{id}', name: 'cart_remove')]
    public function remove($id, CartService $cartService){
        $cartService->remove($id);

        return $this->redirectToRoute("cart_index");
    }

    #[Route('/panier/valider', name: 'cart_valider')]
    public function validerAchat(UserService $userService, UserInterface $user, CartService $cartService){

        $userService->AddAchat($user);
        $cartService->viderCart();
        return $this->redirectToRoute("app_article");
    }

}
