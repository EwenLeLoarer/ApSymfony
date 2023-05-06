<?php 

namespace App\Service\User;

use App\Entity\Achat;
use App\Entity\LigneAchat;
use App\Service\Cart\CartService;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
class UserService{

    protected CartService $cartService;
    protected ManagerRegistry $doctrine;
    public function __construct(CartService $cartService,ManagerRegistry $doctrine){
        $this->cartService = $cartService;
        
        $this->doctrine = $doctrine;
    }


    public function AddAchat($user){
        $idUser = $user->getUserIdentifier();
        $panier = $this->cartService->getFullCart();
        $points = $this->cartService->getTotalPoints();

        if($idUser == null || $idUser == 0){
            return 0;
        }

        $achat = new Achat();
        $achat->setLeUser($user);
        $achat->setTotalPoints($points);
        $achat->setDataAchat(new \DateTime('now'));
        $achat->setTotal($this->cartService->getTotal());

        $em = $this->doctrine->getManager();
        $em->persist($achat);
        $em->flush();

        $this->AddAllLigneAchat($achat);
        return $achat;

    }
    public function AddAllLigneAchat(Achat $achat){
        $panier = $this->cartService->getFullCart();
        
        foreach($panier as $item){
            $LigneAchat = new LigneAchat();
            $LigneAchat->setLeAchat($achat);
            $LigneAchat->setQuantity($item['quantity']);
            $LigneAchat->setSousTotal($item['article']->getPrixArticle() * $item['quantity']);
            $LigneAchat->setSousTotalPoints($item['article']->getPointArticle() * $item['quantity']);
            
            //$em = $this->doctrine->getManager();
            //$em->persist($LigneAchat);
            //$em->flush();
        }
    }

    public function addCarteFidélité(){
        
    }

    public function addPointCarte(){

    }

}


?>
