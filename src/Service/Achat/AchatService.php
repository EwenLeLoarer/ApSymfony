<?php 

namespace App\Service\Achat;

use App\Entity\Achat;
use App\Repository\AchatRepository;
use App\Repository\LigneAchatRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\Cart\CartService;
class AchatService{

    protected $AchatRepo;
    protected $lignesAchatsRepo;
    protected $cartService;
    protected ManagerRegistry $doctrine;
    public function __construct(AchatRepository $repo, ManagerRegistry $doctrine,
    LigneAchatRepository $LigneRepo, CartService $cartService)
    {
        $this->AchatRepo = $repo;
        $this->doctrine = $doctrine;
        $this->lignesAchatsRepo = $LigneRepo;
        $this->cartService = $cartService;
    }

    public function getAllAchatByUser($user){

        $achats = $this->AchatRepo->findBy(['leUser'=> $user]);
        
        foreach($achats as $id){
            $quantity = 0;
            $total = 0;
            $leAchat = $this->AchatRepo->find($id);
            $lignesAchats = $this->lignesAchatsRepo->findBy(['leAchat' =>$leAchat]);
            
            //var_dump($this->AchatRepo->find($id));
            foreach($lignesAchats as $id){
                $quantity += $this->lignesAchatsRepo->find($id)->getQuantity();
                //var_dump($quantity);
            }
            //var_dump($this->AchatRepo->find($id));
            foreach($lignesAchats as $id){    
                $total += $this->lignesAchatsRepo->find($id)->getLeArticle()->getPrixArticle() * $this->lignesAchatsRepo->find($id)->getQuantity();
                //var_dump($total);
            }
            
            $achatsUser[] = [
                'nombreArticle' => $quantity,
                'total' => $total,
                'date' => $leAchat->getDataAchat(),
                'leAchat' => $leAchat
            ];

        }
        //dd($achatsUser);
    return $achatsUser;  
    }

    public function unAchat($id) : Achat{
        $achat = $this->AchatRepo->find($id);
        
        return $achat;
    }


}

?>