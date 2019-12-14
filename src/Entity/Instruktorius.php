<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InstruktoriusRepository")
 */
class Instruktorius
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
    public $asmens_kodas;

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
    public $gimimo_data;

    /**
     * @ORM\Column(type="integer")
     */
    public $vairavimo_stazas_metais;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $telefono_numeris;


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

    public function getGimimoData(): ?\DateTimeInterface
    {
        return $this->gimimo_data;
    }

    public function setGimimoData(?\DateTimeInterface $gimimo_data): self
    {
        $this->gimimo_data = $gimimo_data;

        return $this;
    }

    public function getVairavimoStazasMetais(): ?int
    {
        return $this->vairavimo_stazas_metais;
    }

    public function setVairavimoStazasMetais(int $vairavimo_stazas_metais): self
    {
        $this->vairavimo_stazas_metais = $vairavimo_stazas_metais;

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
     * @ORM\OneToMany(targetEntity="App\Entity\InstruktoriausTvarkarastis", mappedBy="instruktorius")
     */
    public $tvarkarasciai;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LaikomasEgzaminas", mappedBy="instruktorius")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Naudotojas", inversedBy="instruktoriai")
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Filialas", inversedBy="instruktoriai")
     * @ORM\JoinColumn(name="filialo_id", referencedColumnName="id")
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

    public function getPilnasVardas(): ?string
    {
        return $this->vardas.' '.$this->pavarde;
    }

    /**
     * @return Collection|InstruktoriausTvarkarastis[]
     */
    public function getTvarkarastis(): Collection
    {
        return $this->egzaminai;
    }


}
