<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ProjectSearch  
{
    /**
    
     *
     * @var int|null
     */
    private $type;



    /**
     * Get the value of type
     *@Assert\GreaterThan(0)
     * @return  int|null
     */ 
    public function getType()
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
}
