<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ArticleRepository;

class AchatController extends AbstractController
{
    #[Route('/panier', name: 'cart_index')]
    public function index(SessionInterface $session, ArticleRepository $repo): Response
    {
        $panier = $session->get('panier', []);

        $panierAvecData = [];

        foreach($panier as $id => $quantity){
            $panierAvecData[] = [ 
                'article' => $repo->find($id),
                'quantity' => $quantity
            ];
        }

        //dd($panierAvecData);
        $total = 0;

        foreach($panierAvecData as $item){
            $totalItem = $item['article']->getPrixArticle() * $item['quantity'];
            $total += $totalItem;
        }




        return $this->render('achat/index.html.twig', [
            'controller_name' => 'AchatController',
            'items' => $panierAvecData
        ]);
    }

    #[Route('/panier/add/{id}', name: 'cart_add')]
    public function add($id, SessionInterface $session){
  
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else{
            $panier[$id] = 1;
        }
        $session->set('panier', $panier);

        return $this->redirectToRoute("cart_index");

    }

    #[Route('/panier/remove/{id}', name: 'cart_remove')]
    public function remove($id, SessionInterface $session){
        $panier = $session->get('panier', []);

        if(!empty($panier)){
            unset($panier[$id]);
        }

        $session->set('panier',$panier);

        return $this->redirectToRoute("cart_index");   
    }
}
