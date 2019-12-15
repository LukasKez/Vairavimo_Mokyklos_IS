<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlgalapisRepository")
 */
class Algalapis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $data;

    /**
     * @ORM\Column(type="integer")
     */
    private $dirbtos_valandos;

    /**
     * @ORM\Column(type="float")
     */
    private $valandinis_uzmokestis;

    /**
     * @ORM\Column(type="float")
     */
    private $atlyginimas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getDirbtosValandos(): ?int
    {
        return $this->dirbtos_valandos;
    }

    public function setDirbtosValandos(int $dirbtos_valandos): self
    {
        $this->dirbtos_valandos = $dirbtos_valandos;

        return $this;
    }

    public function getValandinisUzmokestis(): ?float
    {
        return $this->valandinis_uzmokestis;
    }

    public function setValandinisUzmokestis(float $valandinis_uzmokestis): self
    {
        $this->valandinis_uzmokestis = $valandinis_uzmokestis;

        return $this;
    }

    public function getAtlyginimas(): ?float
    {
        return $this->atlyginimas;
    }

    public function setAtlyginimas(float $atlyginimas): self
    {
        $this->atlyginimas = $atlyginimas;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Instruktorius", inversedBy="algalapiai")
     * @ORM\JoinColumn(name="instruktorius", referencedColumnName="id")
     */
    private $instruktorius;

    public function getInstruktorius(): ?Instruktorius
    {
        return $this->instruktorius;
    }

    public function setInstruktorius(?Instruktorius $instruktorius): self
    {
        $this->instruktorius = $instruktorius;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InstruktoriausTvarkarastis", inversedBy="algalapiai")
     * @ORM\JoinColumn(name="instruktoriaus_tvarkarastis", referencedColumnName="id")
     */
    private $tvarkarastis;

    public function getTvarkarastis(): ?InstruktoriausTvarkarastis
    {
        return $this->tvarkarastis;
    }

    public function setTvarkarastis(?InstruktoriausTvarkarastis $tvarkarastis): self
    {
        $this->tvarkarastis = $tvarkarastis;

        return $this;
    }
}
