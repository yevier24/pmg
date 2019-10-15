<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TiendaRepository")
 */
class Tienda
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\OneToMany(targetEntity="App\Entity\CargaMeta", mappedBy="tienda", cascade={"persist"})
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Empresa", inversedBy="name")
     * @ORM\JoinColumn(name="empresa", referencedColumnName="id", nullable=true)
     */
    private $empresa;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Zona", inversedBy="name")
     * @ORM\JoinColumn(name="zona", referencedColumnName="id", nullable=true)
     */
    private $zona;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Nombre[]
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    /**
    * Set nombre
    *
    * @param string $nombre
    *
    * @return Nombre
    */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getZona()
    {
        return $this->zona;
    }

    public function setZona($zona)
    {
        $this->zona = $zona;

        return $this;
    }
}
