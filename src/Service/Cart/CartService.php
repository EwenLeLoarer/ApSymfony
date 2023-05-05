<?php

namespace App\Service\Cart;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService{
    protected $requestStack; 
    protected $articleRepo;

    public function __construct(RequestStack $requestStack, ArticleRepository $repo){
        $this->requestStack = $requestStack;
        $this->articleRepo = $repo;
    }

    public function add(int $id){
        $panier = $this->requestStack->getSession()->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else{
            $panier[$id] = 1;
        }
        $this->requestStack->getSession()->set('panier', $panier);
    }

    public function remove(int $id){
        $panier = $this->requestStack->getSession()->get('panier', []);

        if(!empty($panier)){
            unset($panier[$id]);
        }

        $this->requestStack->getSession()->set('panier',$panier);
    }

    public function getFullCart() : array{
        $panier = $this->requestStack->getSession()->get('panier', []);

        $panierAvecData = [];

        foreach($panier as $id => $quantity){
            $panierAvecData[] = [ 
                'article' => $this->articleRepo->find($id),
                'quantity' => $quantity
            ];
        }
        return $panierAvecData;
    }

   public function getTotal() : float{
    $total = 0;

        foreach($this->getFullCart() as $item){
            $total += $item['article']->getPrixArticle() * $item['quantity'];
        }
        return $total;
   }

   public function verifyUser() : float{

    

   }

}

?>