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
     * @ORM\Column(type="integer", length=1)
     */
    private $busena;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    private $pavaru_deze;

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

    /**
     * @ORM\Column(type="integer", length=10)
     */
    private $fk_modelis;


    /**
     * @ORM\Column(type="integer", length=10, nullable=true)
     */
    private $fk_filialas;

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

    public function getFilialas(): ?int
    {
        return $this->fk_filialas;
    }

    public function setFilialas(int $fid): self
    {
        $this->fk_filialas = $fid;

        return $this;
    }

	public function getBusena(): ?int
    {
        return $this->busena;
    }

    public function setBusena(int $busena): self
    {
        $this->busena = $busena;

        return $this;
    }

	public function getPavaruDeze(): ?int
    {
        return $this->pavaru_deze;
    }

    public function setPavaruDeze(int $deze): self
    {
        $this->pavaru_deze = $deze;

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

	public function getModelis(): ?int
    {
        return $this->fk_modelis;
    }

    public function setModelis(int $modelis): self
    {
        $this->fk_modelis = $modelis;
        return $this;
    }


}
