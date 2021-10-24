<?php

namespace App\Entity;

use App\Repository\EmployesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployesRepository::class)
 */
class Employes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $ModifiedAt;

    /**
     * @ORM\OneToMany(targetEntity=HeureProjet::class, mappedBy="Employe")
     */
    private $heureProjets;

    public function __construct()
    {
        $this->heureProjets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->ModifiedAt;
    }

    public function setModifiedAt(?\DateTimeImmutable $ModifiedAt): self
    {
        $this->ModifiedAt = $ModifiedAt;

        return $this;
    }

    /**
     * @return Collection|HeureProjet[]
     */
    public function getHeureProjets(): Collection
    {
        return $this->heureProjets;
    }

    public function addHeureProjet(HeureProjet $heureProjet): self
    {
        if (!$this->heureProjets->contains($heureProjet)) {
            $this->heureProjets[] = $heureProjet;
            $heureProjet->setEmploye($this);
        }

        return $this;
    }

    public function removeHeureProjet(HeureProjet $heureProjet): self
    {
        if ($this->heureProjets->removeElement($heureProjet)) {
            // set the owning side to null (unless already changed)
            if ($heureProjet->getEmploye() === $this) {
                $heureProjet->setEmploye(null);
            }
        }

        return $this;
    }
}
