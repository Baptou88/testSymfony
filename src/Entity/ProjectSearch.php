<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;

class ProjectSearch  
{
    /**
 *
     * @var ?TypeProjet
     */
    private ?TypeProjet $typeProjet;

    /**
     * @var ArrayCollection
     */
    private ArrayCollection $options ;


    #[Pure] public function __construct()
    {
        $this->typeProjet = null;
        $this->options = new ArrayCollection();
    }
    /**
     *
     * @return  TypeProjet|null
     *
     */ 
    public function getTypeProjet(): ?TypeProjet
    {
        return $this->typeProjet;
    }

    /**
     * Set the value of type
     *
     *@param  TypeProjet|null
     *
     * @return  self
     */ 
    public function setTypeProjet(TypeProjet $typeprojet)
    {
        $this->typeProjet = $typeprojet;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     */
    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }

}
