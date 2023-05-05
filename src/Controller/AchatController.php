<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;
use App\Repository\ArticleRepository;
use App\Service\Cart\CartService;

class AchatController extends AbstractController
{
    #[Route('/panier', name: 'cart_index')]
    public function index(SessionInterface $session,CartService $cartService): Response
    {
        $panier = $session->get('panier', []);

       $panierAvecData = $cartService->getFullCart();
       $total = $cartService->getTotal();

        foreach($panierAvecData as $item){
            $totalItem = $item['article']->getPrixArticle() * $item['quantity'];
            $total += $totalItem;
        }




        return $this->render('achat/index.html.twig', [
            'controller_name' => 'AchatController',
            'items' => $panierAvecData,
            'totalItem' => $total
        ]);
    }

    #[Route('/panier/add/{id}', name: 'cart_add')]
    public function add($id, CartService $cartService){

        return $this->redirectToRoute("cart_index");  
    }

    #[Route('/panier/remove/{id}', name: 'cart_remove')]
    public function remove($id, CartService $cartService){
        $cartService->remove($id);

        return $this->redirectToRoute("cart_index");
    }


}
