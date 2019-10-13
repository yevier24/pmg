<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CargaRepository")
 */
class Carga
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $columna1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $columna2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $columna3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColumna1(): ?string
    {
        return $this->columna1;
    }

    public function setColumna1(?string $columna1): self
    {
        $this->columna1 = $columna1;

        return $this;
    }

    public function getColumna2(): ?string
    {
        return $this->columna2;
    }

    public function setColumna2(?string $columna2): self
    {
        $this->columna2 = $columna2;

        return $this;
    }

    public function getColumna3(): ?string
    {
        return $this->columna3;
    }

    public function setColumna3(?string $columna3): self
    {
        $this->columna3 = $columna3;

        return $this;
    }
}
