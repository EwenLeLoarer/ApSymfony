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
    #[Route('/panier', name: 'app_achat')]
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

        dd($panierAvecData);





        return $this->render('achat/index.html.twig', [
            'controller_name' => 'AchatController',
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

        dd($session->get('panier'));

    }
}
