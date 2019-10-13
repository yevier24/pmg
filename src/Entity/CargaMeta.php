<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CargaMetaRepository")
 */
class CargaMeta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cadena;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tienda;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $diaSemana;

    /**
     * @ORM\Column(type="integer")
     */
    private $semana;

    /**
     * @ORM\Column(type="decimal", precision=19, scale=2)
     */
    private $meta;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCadena(): ?string
    {
        return $this->cadena;
    }

    public function setCadena(string $cadena): self
    {
        $this->cadena = $cadena;

        return $this;
    }

    public function getTienda(): ?string
    {
        return $this->tienda;
    }

    public function setTienda(string $tienda): self
    {
        $this->tienda = $tienda;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getDiaSemana(): ?string
    {
        return $this->diaSemana;
    }

    public function setDiaSemana(string $diaSemana): self
    {
        $this->diaSemana = $diaSemana;

        return $this;
    }

    public function getSemana(): ?int
    {
        return $this->semana;
    }

    public function setSemana(int $semana): self
    {
        $this->semana = $semana;

        return $this;
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function setMeta($meta)
    {
        $this->meta = $meta;

        return $this;
    }
}
