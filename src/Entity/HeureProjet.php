<?php

namespace App\Entity;

use App\Repository\HeureProjetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HeureProjetRepository::class)
 */
class HeureProjet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="heureProjets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Employe;

    /**
     * @ORM\Column(type="float")
     */
    private $duree;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHidden;

    /**
     * @ORM\ManyToOne(targetEntity=Projects::class, inversedBy="heureProjets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getEmploye(): ?Users
    {
        return $this->Employe;
    }

    public function setEmploye(?Users $Employe): self
    {
        $this->Employe = $Employe;

        return $this;
    }

    public function getDuree(): ?float
    {
        return $this->duree;
    }

    public function setDuree(float $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getIsHidden(): ?bool
    {
        return $this->isHidden;
    }

    public function setIsHidden(bool $isHidden): self
    {
        $this->isHidden = $isHidden;

        return $this;
    }

    public function getProject(): ?Projects
    {
        return $this->project;
    }

    public function setProject(?Projects $project): self
    {
        $this->project = $project;

        return $this;
    }
}
