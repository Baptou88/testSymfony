<?php

namespace App\Entity;

use App\Repository\TypeProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeProjetRepository::class)
 */
class TypeProjet
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
     * @ORM\Column(type="boolean")
     */
    private $IsVisible;

    /**
     * @ORM\OneToMany(targetEntity=Projects::class, mappedBy="TypeProjet")
     */
    private $Projects;



    public function __construct()
    {

        $this->Projects = new ArrayCollection();
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

    public function getIsVisible(): ?bool
    {
        return $this->IsVisible;
    }

    public function setIsVisible(bool $IsVisible): self
    {
        $this->IsVisible = $IsVisible;

        return $this;
    }

    /**
     * @return Collection|Projects[]
     */
    public function getProject(): Collection
    {
        return $this->Projects;
    }

    public function addProject(Projects $project): self
    {
        if (!$this->Projects->contains($project)) {
            $this->Projects[] = $project;
            $project->setTypeProjet($this);
        }

        return $this;
    }

    public function removeProject(Projects $project): self
    {
        if ($this->Projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getTypeProjet() === $this) {
                $project->setTypeProjet(null);
            }
        }

        return $this;
    }






}
