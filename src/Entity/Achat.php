<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchatRepository::class)]
class Achat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $total = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dataAchat = null;

    #[ORM\Column]
    private ?int $totalPoints = null;

    #[ORM\ManyToOne(inversedBy: 'lesAchats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $leUser = null;

    #[ORM\OneToMany(mappedBy: 'leAchat', targetEntity: LigneAchat::class)]
    private Collection $lesLignesAchats;

    public function __construct()
    {
        $this->lesLignesAchats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getDataAchat(): ?\DateTimeInterface
    {
        return $this->dataAchat;
    }

    public function setDataAchat(\DateTimeInterface $dataAchat): self
    {
        $this->dataAchat = $dataAchat;

        return $this;
    }

    public function getTotalPoints(): ?int
    {
        return $this->totalPoints;
    }

    public function setTotalPoints(int $totalPoints): self
    {
        $this->totalPoints = $totalPoints;

        return $this;
    }

    public function getLeUser(): ?User
    {
        return $this->leUser;
    }

    public function setLeUser(?User $leUser): self
    {
        $this->leUser = $leUser;

        return $this;
    }

    /**
     * @return Collection<int, LigneAchat>
     */
    public function getLesLignesAchats(): Collection
    {
        return $this->lesLignesAchats;
    }

    public function addLesLignesAchat(LigneAchat $lesLignesAchat): self
    {
        if (!$this->lesLignesAchats->contains($lesLignesAchat)) {
            $this->lesLignesAchats->add($lesLignesAchat);
            $lesLignesAchat->setLeAchat($this);
        }

        return $this;
    }

    public function removeLesLignesAchat(LigneAchat $lesLignesAchat): self
    {
        if ($this->lesLignesAchats->removeElement($lesLignesAchat)) {
            // set the owning side to null (unless already changed)
            if ($lesLignesAchat->getLeAchat() === $this) {
                $lesLignesAchat->setLeAchat(null);
            }
        }

        return $this;
    }
}
