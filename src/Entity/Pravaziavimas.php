<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PravaziavimasRepository")
 */
class Pravaziavimas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\Column(type="float")
     */
    private $ivertinimas;

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

    public function getIvertinimas(): ?float
    {
        return $this->ivertinimas;
    }

    public function setIvertinimas(float $ivertinimas): self
    {
        $this->ivertinimas = $ivertinimas;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\KlientoTvarkarastis", inversedBy="pravaziavimai")
     * @ORM\JoinColumn(name="kliento_tvarkarastis", referencedColumnName="id")
     */
    private $kliento_tvarkarastis;

    public function getKlientoTvarkarastis(): ?KlientoTvarkarastis
    {
        return $this->kliento_tvarkarastis;
    }

    public function setKlientoTvarkarastis(?KlientoTvarkarastis $kliento_tvarkarastis): self
    {
        $this->kliento_tvarkarastis = $kliento_tvarkarastis;

        return $this;
    }

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InstruktoriausTvarkarastis", inversedBy="pravaziavimai")
     * @ORM\JoinColumn(name="instruktoriaus_tvarkarastis", referencedColumnName="id")
     */
    private $instruktoriaus_tvarkarastis;

    public function getInstruktoriausTvarkarastis(): ?InstruktoriausTvarkarastis
    {
        return $this->instruktoriaus_tvarkarastis;
    }

    public function setInstruktoriausTvarkarastis(?InstruktoriausTvarkarastis $instruktoriaus_tvarkarastis): self
    {
        $this->instruktoriaus_tvarkarastis = $instruktoriaus_tvarkarastis;

        return $this;
    }
}
