<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AutomobilisRepository")
 */
class TransportoPriemone
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $valstybiniai_nr;

    /**
     * @ORM\Column(type="integer", length=4)
     */
    private $pagaminimo_metai;

    /**
     * @ORM\Column(type="float",  nullable=true)
     */
	  private $ilguma;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $plokstuma;

	 /**
     * @ORM\Column(type="string", length=20)
     */
    private $kebulas;

	 /**
     * @ORM\Column(type="string", length=3)
     */
    private $kategorija;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValstybiniaiNr(): ?string
    {
        return $this->valstybiniai_nr;
    }

    public function setValstybiniaiNr(string $numeriai): self
    {
        $this->valstybiniai_nr = $numeriai;

        return $this;
    }

    public function getPagaminimoMetai(): ?int
    {
        return $this->pagaminimo_metai;
    }

    public function setPagaminimoMetai(int $metai): self
    {
        $this->pagaminimo_metai = $metai;

        return $this;
    }

	public function getIlguma(): ?float
    {
        return $this->ilguma;
    }

    public function setIlguma(float $ilguma): self
    {
        $this->ilguma = $ilguma;

        return $this;
    }

	public function getPlokstuma(): ?float
    {
        return $this->plokstuma;
    }

    public function setPlokstuma(float $plokstuma): self
    {
        $this->plokstuma = $plokstuma;
        return $this;
    }

	public function getKategorija(): ?string
    {
        return $this->kategorija;
    }

    public function setKategorija(string $kategorija1): self
    {
        $this->kategorija = $kategorija1;
        return $this;
    }

	public function getKebulas(): ?string
    {
        return $this->kebulas;
    }

    public function setKebulas(string $kebulas1): self
    {
        $this->kebulas = $kebulas1;
        return $this;
    }

      /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TransportoPriemonesBusena", inversedBy="transporto_priemones")
     * @ORM\JoinColumn(name="busena", referencedColumnName="id")
     */
    private $busena;

    public function getTransportoPriemonesBusena(): ?TransportoPriemonesBusena
    {
        return $this->busena;
    }

    public function setTransportoPriemonesBusena(?TransportoPriemonesBusena $busena): self
    {
        $this->busena = $busena;

        return $this;
    }

      /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PavaruDeze", inversedBy="transporto_priemones")
     * @ORM\JoinColumn(name="pavaru_deze", referencedColumnName="id")
     */
    private $pavazu_deze;

    public function getPavaruDeze(): ?PavaruDeze
    {
        return $this->pavazu_deze;
    }

    public function setPavaruDeze(?PavaruDeze $pavazu_deze): self
    {
        $this->pavazu_deze = $pavazu_deze;

        return $this;
    }

       /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Modelis", inversedBy="transporto_priemones")
     * @ORM\JoinColumn(name="modelis", referencedColumnName="id")
     */
    private $modelis;

    public function getModelis(): ?Modelis
    {
        return $this->modelis;
    }

    public function setModelis(?Modelis $modelis): self
    {
        $this->modelis = $modelis;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Filialas", inversedBy="transporto_priemones")
     * @ORM\JoinColumn(name="filialas", referencedColumnName="id")
     */
    private $filialas;

    public function getFilialas(): ?Filialas
    {
        return $this->filialas;
    }

    public function setFilialas(?Filialas $filialas): self
    {
        $this->filialas = $filialas;

        return $this;
    }

}
