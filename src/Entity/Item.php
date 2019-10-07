<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)     
     * @ORM\OneToOne(targetEntity="Trabajador", inversedBy="foto")
     */
    private $image; 

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|image[]
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Set image
     *
     * @param string $image
     *
     * @return Item
     */
    public function setImage( $image)
    {
        $this->image = $image;

        return $this;
    }

}
