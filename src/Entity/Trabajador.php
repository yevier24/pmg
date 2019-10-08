<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TrabajadorRepository")
 */
class Trabajador
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
    private $email;

    /**
     * @var string The hashed pass
     * @ORM\Column(type="string", nullable=true)
     */
    private $pass;

    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\OneToMany(targetEntity="App\Entity\Trabajador", mappedBy="supervisor")
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true))
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="smallint")
     */
    private $tipo_trabajador;

    /**
     * @ORM\OneToOne(targetEntity="Item")
     * @ORM\JoinColumn(name="foto", referencedColumnName="id")
     */
    private $foto;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $rut;

   /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trabajador", inversedBy="name")
     * @ORM\JoinColumn(name="supervisor", referencedColumnName="id", nullable=true)
     */
    private $supervisor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPass(): string
    {
        return (string) $this->pass;
    }

    public function setPass(string $pass): self
    {
        $this->pass = $pass;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getTipoTrabajador(): ?int
    {
        return $this->tipo_trabajador;
    }

    public function setTipoTrabajador(int $tipo_trabajador): self
    {
        $this->tipo_trabajador = $tipo_trabajador;

        return $this;
    }

   
    public function getFoto()
    {
        return $this->foto;
    }
    
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }


    public function getRut(): ?string
    {
        return $this->rut;
    }

    public function setRut(?string $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function getSupervisor()
    {
        return $this->supervisor;
    }

    public function setSupervisor($supervisor)
    {
        $this->supervisor = $supervisor;

        return $this;
    }
}
