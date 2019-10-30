<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GastosRepository")
 */
class Gastos
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
    private $modelo_pdv_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_pdv_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pdv_1_q;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $modelo_pdv_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_pdv_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pdv_2_q;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sup_dias_se;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_supervision;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zona_ciudad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cadena;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tienda;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $venta_promedio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $incremento_venta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $venta_total;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comision_retail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $margen_tienda;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $supervision;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vendedor_reposicion_01;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vendedor_reposicion_02;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bodegaje;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $packing;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picking;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $transporte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $costo_mercaderia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $merma;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $muebles;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $margen_operacional;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gastos_administracion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultado_actual;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultado_modelo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diferencial;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_i;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_u;
    
    function __construct()
    {
        $this->fecha_i = new \DateTime();
        $this->fecha_u = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModeloPdv1(): ?string
    {
        return $this->modelo_pdv_1;
    }

    public function setModeloPdv1(?string $modelo_pdv_1): self
    {
        $this->modelo_pdv_1 = $modelo_pdv_1;

        return $this;
    }

    public function getTipoPdv1(): ?string
    {
        return $this->tipo_pdv_1;
    }

    public function setTipoPdv1(?string $tipo_pdv_1): self
    {
        $this->tipo_pdv_1 = $tipo_pdv_1;

        return $this;
    }

    public function getPdv1Q(): ?string
    {
        return $this->pdv_1_q;
    }

    public function setPdv1Q(?string $pdv_1_q): self
    {
        $this->pdv_1_q = $pdv_1_q;

        return $this;
    }

    public function getModeloPdv2(): ?string
    {
        return $this->modelo_pdv_2;
    }

    public function setModeloPdv2(?string $modelo_pdv_2): self
    {
        $this->modelo_pdv_2 = $modelo_pdv_2;

        return $this;
    }

    public function getTipoPdv2(): ?string
    {
        return $this->tipo_pdv_2;
    }

    public function setTipoPdv2(?string $tipo_pdv_2): self
    {
        $this->tipo_pdv_2 = $tipo_pdv_2;

        return $this;
    }

    public function getPdv2Q(): ?string
    {
        return $this->pdv_2_q;
    }

    public function setPdv2Q(?string $pdv_2_q): self
    {
        $this->pdv_2_q = $pdv_2_q;

        return $this;
    }

    public function getSupDiasSe(): ?string
    {
        return $this->sup_dias_se;
    }

    public function setSupDiasSe(?string $sup_dias_se): self
    {
        $this->sup_dias_se = $sup_dias_se;

        return $this;
    }

    public function getTipoSupervision(): ?string
    {
        return $this->tipo_supervision;
    }

    public function setTipoSupervision(?string $tipo_supervision): self
    {
        $this->tipo_supervision = $tipo_supervision;

        return $this;
    }

    public function getZonaCiudad(): ?string
    {
        return $this->zona_ciudad;
    }

    public function setZonaCiudad(?string $zona_ciudad): self
    {
        $this->zona_ciudad = $zona_ciudad;

        return $this;
    }

    public function getCadena(): ?string
    {
        return $this->cadena;
    }

    public function setCadena(?string $cadena): self
    {
        $this->cadena = $cadena;

        return $this;
    }

    public function getTienda(): ?string
    {
        return $this->tienda;
    }

    public function setTienda(?string $tienda): self
    {
        $this->tienda = $tienda;

        return $this;
    }

    public function getVentaPromedio(): ?string
    {
        return $this->venta_promedio;
    }

    public function setVentaPromedio(?string $venta_promedio): self
    {
        $this->venta_promedio = $venta_promedio;

        return $this;
    }

    public function getIncrementoVenta(): ?string
    {
        return $this->incremento_venta;
    }

    public function setIncrementoVenta(?string $incremento_venta): self
    {
        $this->incremento_venta = $incremento_venta;

        return $this;
    }

    public function getVentaTotal(): ?string
    {
        return $this->venta_total;
    }

    public function setVentaTotal(?string $venta_total): self
    {
        $this->venta_total = $venta_total;

        return $this;
    }

    public function getComisionRetail(): ?string
    {
        return $this->comision_retail;
    }

    public function setComisionRetail(?string $comision_retail): self
    {
        $this->comision_retail = $comision_retail;

        return $this;
    }

    public function getMargenTienda(): ?string
    {
        return $this->margen_tienda;
    }

    public function setMargenTienda(?string $margen_tienda): self
    {
        $this->margen_tienda = $margen_tienda;

        return $this;
    }

    public function getSupervision(): ?string
    {
        return $this->supervision;
    }

    public function setSupervision(?string $supervision): self
    {
        $this->supervision = $supervision;

        return $this;
    }

    public function getVendedorReposicion01(): ?string
    {
        return $this->vendedor_reposicion_01;
    }

    public function setVendedorReposicion01(?string $vendedor_reposicion_01): self
    {
        $this->vendedor_reposicion_01 = $vendedor_reposicion_01;

        return $this;
    }

    public function getVendedorReposicion02(): ?string
    {
        return $this->vendedor_reposicion_02;
    }

    public function setVendedorReposicion02(?string $vendedor_reposicion_02): self
    {
        $this->vendedor_reposicion_02 = $vendedor_reposicion_02;

        return $this;
    }

    public function getBodegaje(): ?string
    {
        return $this->bodegaje;
    }

    public function setBodegaje(?string $bodegaje): self
    {
        $this->bodegaje = $bodegaje;

        return $this;
    }

    public function getPacking(): ?string
    {
        return $this->packing;
    }

    public function setPacking(?string $packing): self
    {
        $this->packing = $packing;

        return $this;
    }

    public function getPicking(): ?string
    {
        return $this->picking;
    }

    public function setPicking(?string $picking): self
    {
        $this->picking = $picking;

        return $this;
    }

    public function getTransporte(): ?string
    {
        return $this->transporte;
    }

    public function setTransporte(?string $transporte): self
    {
        $this->transporte = $transporte;

        return $this;
    }

    public function getCostoMercaderia(): ?string
    {
        return $this->costo_mercaderia;
    }

    public function setCostoMercaderia(?string $costo_mercaderia): self
    {
        $this->costo_mercaderia = $costo_mercaderia;

        return $this;
    }

    public function getMerma(): ?string
    {
        return $this->merma;
    }

    public function setMerma(?string $merma): self
    {
        $this->merma = $merma;

        return $this;
    }

    public function getMuebles(): ?string
    {
        return $this->muebles;
    }

    public function setMuebles(?string $muebles): self
    {
        $this->muebles = $muebles;

        return $this;
    }

    public function getMargenOperacional(): ?string
    {
        return $this->margen_operacional;
    }

    public function setMargenOperacional(?string $margen_operacional): self
    {
        $this->margen_operacional = $margen_operacional;

        return $this;
    }

    public function getGastosAdministracion(): ?string
    {
        return $this->gastos_administracion;
    }

    public function setGastosAdministracion(?string $gastos_administracion): self
    {
        $this->gastos_administracion = $gastos_administracion;

        return $this;
    }

    public function getResultadoActual(): ?string
    {
        return $this->resultado_actual;
    }

    public function setResultadoActual(?string $resultado_actual): self
    {
        $this->resultado_actual = $resultado_actual;

        return $this;
    }

    public function getResultadoModelo(): ?string
    {
        return $this->resultado_modelo;
    }

    public function setResultadoModelo(?string $resultado_modelo): self
    {
        $this->resultado_modelo = $resultado_modelo;

        return $this;
    }

    public function getDiferencial(): ?string
    {
        return $this->diferencial;
    }

    public function setDiferencial(?string $diferencial): self
    {
        $this->diferencial = $diferencial;

        return $this;
    }

    public function getFechaI(): ?\DateTimeInterface
    {
        return $this->fecha_i;
    }

    public function setFechaI(\DateTimeInterface $fecha_i): self
    {
        $this->fecha_i = $fecha_i;

        return $this;
    }

    public function getFechaU(): ?\DateTimeInterface
    {
        return $this->fecha_u;
    }

    public function setFechaU(\DateTimeInterface $fecha_u): self
    {
        $this->fecha_u = $fecha_u;

        return $this;
    }
}
