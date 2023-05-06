<?php

namespace App\Entity;

use App\Repository\CarteFidelitéRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarteFidelitéRepository::class)]
class CarteFidelité
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\OneToOne(mappedBy: 'laCarteFidélité', cascade: ['persist', 'remove'])]
    private ?User $leUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getLeUser(): ?User
    {
        return $this->leUser;
    }

    public function setLeUser(?User $leUser): self
    {
        // unset the owning side of the relation if necessary
        if ($leUser === null && $this->leUser !== null) {
            $this->leUser->setLaCarteFidélité(null);
        }

        // set the owning side of the relation if necessary
        if ($leUser !== null && $leUser->getLaCarteFidélité() !== $this) {
            $leUser->setLaCarteFidélité($this);
        }

        $this->leUser = $leUser;

        return $this;
    }
}
