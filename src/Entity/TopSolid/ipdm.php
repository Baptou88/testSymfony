<?php


namespace App\Entity\TopSolid;

use Symfony\Component\Serializer\Annotation\Groups;

class ipdm implements \Serializable
{
    /**
     * @var string|null
     * @Groups({"default"})
     */
    public  ?string $id;

    public function __construct(string $ipdmobject){

        $this->id = $ipdmobject;
    }
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function serialize(): string
    {

        return serialize([
            $this->id
        ]);
    }

    public function unserialize($data)
    {
        // TODO: Implement unserialize() method.
    }
}