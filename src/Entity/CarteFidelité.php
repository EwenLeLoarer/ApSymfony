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
    private ?int $numero_carte = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\OneToOne(mappedBy: 'laCarteFidélité', cascade: ['persist', 'remove'])]
    private ?Client $leClient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCarte(): ?int
    {
        return $this->numero_carte;
    }

    public function setNumeroCarte(int $numero_carte): self
    {
        $this->numero_carte = $numero_carte;

        return $this;
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

    public function getLeClient(): ?Client
    {
        return $this->leClient;
    }

    public function setLeClient(?Client $leClient): self
    {
        // unset the owning side of the relation if necessary
        if ($leClient === null && $this->leClient !== null) {
            $this->leClient->setLaCarteFidélité(null);
        }

        // set the owning side of the relation if necessary
        if ($leClient !== null && $leClient->getLaCarteFidélité() !== $this) {
            $leClient->setLaCarteFidélité($this);
        }

        $this->leClient = $leClient;

        return $this;
    }
}
