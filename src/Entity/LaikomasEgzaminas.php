<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Table(name="laikomas_egzaminas")
 * @ORM\Entity(repositoryClass="App\Repository\LaikomasEgzaminasRepository")
 */
class LaikomasEgzaminas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $balas;

    /**
     * @ORM\Column(type="integer")
     */
    private $bandymo_numeris;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBalas(): ?float
    {
        return $this->balas;
    }

    public function setBalas(float $balas): self
    {
        $this->balas = $balas;

        return $this;
    }

    public function getBandymoNumeris(): ?int
    {
        return $this->bandymo_numeris;
    }

    public function setBandymoNumeris(int $bandymo_numeris): self
    {
        $this->bandymo_numeris = $bandymo_numeris;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Egzaminas", inversedBy="laikomi_egzaminai")
     * @ORM\JoinColumn(name="fk_Egzaminas", referencedColumnName="id")
     */
    private $fk_egzaminas;

    public function getEgzaminas(): ?Egzaminas
    {
        return $this->fk_egzaminas;
    }

    public function setEgzaminas(?Egzaminas $fk_egzaminas): self
    {
        $this->fk_egzaminas = $fk_egzaminas;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Klientas", inversedBy="egzaminai")
     * @ORM\JoinColumn(name="fk_Klientas", referencedColumnName="id")
     */
    private $klientas;

    public function getKlientas(): ?Klientas
    {
        return $this->klientas;
    }

    public function setKlientas(?Klientas $klientas): self
    {
        $this->klientas = $klientas;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Instruktorius", inversedBy="egzaminai")
     * @ORM\JoinColumn(name="fk_Instruktorius", referencedColumnName="id")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\RezultatoTipas", inversedBy="egzaminai")
     * @ORM\JoinColumn(name="rezultatas", referencedColumnName="id")
     */
    private $rezultatas;

    public function getRezultatas(): ?RezultatoTipas
    {
        return $this->rezultatas;
    }

    public function setRezultatas(?RezultatoTipas $rezultatas): self
    {
        $this->rezultatas = $rezultatas;

        return $this;
    }
}
