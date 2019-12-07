<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KlientasRepository")
 */
class Klientas
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
    private $asmens_kodas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vardas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pavarde;

    /**
     * @ORM\Column(type="date")
     */
    private $gimimo_metai;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefono_numeris;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAsmensKodas(): ?string
    {
        return $this->asmens_kodas;
    }

    public function setAsmensKodas(string $asmens_kodas): self
    {
        $this->asmens_kodas = $asmens_kodas;

        return $this;
    }

    public function getVardas(): ?string
    {
        return $this->vardas;
    }

    public function setVardas(string $vardas): self
    {
        $this->vardas = $vardas;

        return $this;
    }

    public function getPavarde(): ?string
    {
        return $this->pavarde;
    }

    public function setPavarde(string $pavarde): self
    {
        $this->pavarde = $pavarde;

        return $this;
    }

    public function getGimimoMetai(): ?\DateTimeInterface
    {
        return $this->gimimo_metai;
    }

    public function setGimimoMetai(\DateTimeInterface $gimimo_metai): self
    {
        $this->gimimo_metai = $gimimo_metai;

        return $this;
    }

    public function getTelefonoNumeris(): ?string
    {
        return $this->telefono_numeris;
    }

    public function setTelefonoNumeris(string $telefono_numeris): self
    {
        $this->telefono_numeris = $telefono_numeris;

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\KlientoTvarkarastis", mappedBy="klientas")
     */
    private $tvarkarasciai;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LaikomasEgzaminas", mappedBy="klientas")
     */
    private $egzaminai;

    public function __construct()
    {
        $this->egzaminai = new ArrayCollection();
        $this->tvarkarasciai = new ArrayCollection();
    }

    /**
     * @return Collection|LaikomasEgzaminas[]
     */
    public function getEgzaminai(): Collection
    {
        return $this->egzaminai;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Naudotojas", inversedBy="klientai")
     * @ORM\JoinColumn(name="naudotojo_id", referencedColumnName="id")
     */
    private $naudotojo_id;

    public function getNaudotojoId(): ?Naudotojas
    {
        return $this->naudotojo_id;
    }

    public function setNaudotojoId(?Naudotojas $naudotojo_id): self
    {
        $this->naudotojo_id = $naudotojo_id;

        return $this;
    }

    public function getPilnasVardas(): ?string
    {
        return $this->vardas.' '.$this->pavarde;
    }



    /**
     * @return Collection|KlientoTvarkarastis[]
     */
    public function getTvarkarastis(): Collection
    {
        return $this->tvarkarasciai;
    }


}
