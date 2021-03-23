<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class ProjectSearch  
{
    /**
    
     *
     * @var int|null
     */
    private $type;

    /**
     * @var ArrayCollection
     */

    private $options ;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }
    /**
     * Get the value of type
     *@Assert\GreaterThan(0)
     * @return  int|null
     */ 
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param  int|null  $type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

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
