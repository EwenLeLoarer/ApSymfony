<?php

namespace App\Entity;

use App\Repository\LigneAchatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneAchatRepository::class)]
class LigneAchat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?float $sousTotal = null;

    #[ORM\Column]
    private ?float $sousTotalPoints = null;

    #[ORM\ManyToOne(inversedBy: 'lesLignesAchats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Achat $leAchat = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $leArticle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getSousTotal(): ?float
    {
        return $this->sousTotal;
    }

    public function setSousTotal(float $sousTotal): self
    {
        $this->sousTotal = $sousTotal;

        return $this;
    }

    public function getSousTotalPoints(): ?float
    {
        return $this->sousTotalPoints;
    }

    public function setSousTotalPoints(float $sousTotalPoints): self
    {
        $this->sousTotalPoints = $sousTotalPoints;

        return $this;
    }

    public function getLeAchat(): ?Achat
    {
        return $this->leAchat;
    }

    public function setLeAchat(?Achat $leAchat): self
    {
        $this->leAchat = $leAchat;

        return $this;
    }

    public function getLeArticle(): ?Article
    {
        return $this->leArticle;
    }

    public function setLeArticle(Article $leArticle): self
    {
        $this->leArticle = $leArticle;

        return $this;
    }
}
