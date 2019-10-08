<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZonaRepository")
 */
class Zona
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\OneToMany(targetEntity="App\Entity\Tienda", mappedBy="zona", cascade={"persist"})
     */
    public $name;
    
    public function __toString()
    {
        return $this->name;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Name[]
     */
    public function getName()
    {
        return $this->name;
    }
    /**
    * Set name
    *
    * @param string $name
    *
    * @return Name
    */
    public function setNames($name)
    {
        $this->name = $name;

        return $this;
    }
}
