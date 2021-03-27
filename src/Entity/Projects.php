<?php

namespace App\Entity;

use App\Repository\ProjectsRepository;
use Cocur\Slugify\Slugify;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ProjectsRepository::class)
 * @UniqueEntity("code")
 */
class Projects
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
    private $code;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateEntree;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DateDelai;

    /**
     * @ORM\Column(type="integer")
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Option::class, inversedBy="projects")
     */
    private $options;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProjet::class, inversedBy="projects")
     *
     */
    private $TypeProjet;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="projects")
     *  @ORM\JoinColumn(name="clients_id", referencedColumnName="id")
     */
    private $clients;



    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
    public function getSlug(): string
    {
        return  (new Slugify())->slugify($this->code);

    }

    public function getDateEntree(): ?DateTimeInterface
    {
        return $this->DateEntree;
    }

    public function setDateEntree(DateTimeInterface $DateEntree): self
    {
        $this->DateEntree = $DateEntree;

        return $this;
    }

    public function getDateDelai(): ?DateTimeInterface
    {
        return $this->DateDelai;
    }

    public function setDateDelai(?DateTimeInterface $DateDelai): self
    {
        $this->DateDelai = $DateDelai;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->Type;
    }

    public function setType(int $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->addProject($this);
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        if ($this->options->removeElement($option)) {
            $option->removeProject($this);
        }

        return $this;
    }


    /**
     * @return DateTimeInterface|null
     */
    public function getStartDate(): ?DateTimeInterface {
        return $this->getDateEntree();
    }

    public function getTypeProjet(): ?TypeProjet
    {
        return $this->TypeProjet;
    }

    public function setTypeProjet(?TypeProjet $TypeProjet): self
    {
        $this->TypeProjet = $TypeProjet;

        return $this;
    }



    public function getClients(): ?Clients
    {
        return $this->clients;
    }

    public function setClients(?Clients $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

}
