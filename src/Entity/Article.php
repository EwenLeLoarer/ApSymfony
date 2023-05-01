<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomArticle = null;

    #[ORM\Column]
    private ?int $prixArticle = null;

    #[ORM\Column]
    private ?int $PointArticle = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Promotions $laPromotion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomArticle(): ?string
    {
        return $this->nomArticle;
    }

    public function setNomArticle(string $nomArticle): self
    {
        $this->nomArticle = $nomArticle;

        return $this;
    }

    public function getPrixArticle(): ?int
    {
        return $this->prixArticle;
    }

    public function setPrixArticle(int $prixArticle): self
    {
        $this->prixArticle = $prixArticle;

        return $this;
    }

    public function getPointArticle(): ?int
    {
        return $this->PointArticle;
    }

    public function setPointArticle(int $PointArticle): self
    {
        $this->PointArticle = $PointArticle;

        return $this;
    }

    public function getLaPromotion(): ?Promotions
    {
        return $this->laPromotion;
    }

    public function setLaPromotion(?Promotions $laPromotion): self
    {
        $this->laPromotion = $laPromotion;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}
