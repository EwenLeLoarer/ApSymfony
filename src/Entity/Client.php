<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column]
    private ?int $telephone = null;

    #[ORM\OneToMany(mappedBy: 'leClient', targetEntity: Achat::class)]
    private Collection $lesAchats;

    #[ORM\OneToOne(inversedBy: 'leClient', cascade: ['persist', 'remove'])]
    private ?CarteFidelité $laCarteFidélité = null;

    public function __construct()
    {
        $this->lesAchats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, Achat>
     */
    public function getLesAchats(): Collection
    {
        return $this->lesAchats;
    }

    public function addLesAchat(Achat $lesAchat): self
    {
        if (!$this->lesAchats->contains($lesAchat)) {
            $this->lesAchats->add($lesAchat);
            $lesAchat->setLeClient($this);
        }

        return $this;
    }

    public function removeLesAchat(Achat $lesAchat): self
    {
        if ($this->lesAchats->removeElement($lesAchat)) {
            // set the owning side to null (unless already changed)
            if ($lesAchat->getLeClient() === $this) {
                $lesAchat->setLeClient(null);
            }
        }

        return $this;
    }

    public function getLaCarteFidélité(): ?CarteFidelité
    {
        return $this->laCarteFidélité;
    }

    public function setLaCarteFidélité(?CarteFidelité $laCarteFidélité): self
    {
        $this->laCarteFidélité = $laCarteFidélité;

        return $this;
    }
}
