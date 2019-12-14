<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="egzaminas")
 * @ORM\Entity(repositoryClass="App\Repository\EgzaminasRepository")
 */
class Egzaminas
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresas;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
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

    public function getAdresas(): ?string
    {
        return $this->adresas;
    }

    public function setAdresas(string $adresas): self
    {
        $this->adresas = $adresas;

        return $this;
    }


     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EgzaminuTipai", inversedBy="egzaminai")
     * @ORM\JoinColumn(name="tipas", referencedColumnName="id")
     */
    private $fk_tipas;

    public function EgzaminoTipas(): ?EgzaminuTipai
    {
        return $this->fk_tipas;
    }

    public function setEgzaminoTipas(?EgzaminuTipai $fk_tipas): self
    {
        $this->fk_tipas = $fk_tipas;

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LaikomasEgzaminas", mappedBy="fk_egzaminas")
     */
    private $laikomi_egzaminai;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\KlientoTvarkarastis")
     * @ORM\JoinTable(name="kliento_tvarkarascio_egzaminas")
     */
    private $kliento_tvarkarascio_egzaminas;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\InstruktoriausTvarkarastis")
     * @ORM\JoinTable(name="instruktoriaus_tvarkarascio_egzaminas")
     */
    private $instruktoriaus_tvarkarascio_egzaminas;

    public function __construct()
    {
        $this->laikomi_egzaminai = new ArrayCollection();
        $this->kliento_tvarkarascio_egzaminas = new ArrayCollection();
        $this->instruktoriaus_tvarkarascio_egzaminas = new ArrayCollection();
    }

    /**
     * @return Collection|LaikomasEgzaminas[]
     */
    public function getLaikomiEgzaminai(): Collection
    {
        return $this->laikomi_egzaminai;
    }

    public function addKlientoEgzaminas(KlientoTvarkarastis $tvarkarastis){
        if ($this->kliento_tvarkarascio_egzaminas->contains($tvarkarastis)) {
            return;
        }
        $this->kliento_tvarkarascio_egzaminas[] = $tvarkarastis;
    }

    public function addInstruktoriausEgzaminas(InstruktoriausTvarkarastis $tvarkarastis){
        if ($this->instruktoriaus_tvarkarascio_egzaminas->contains($tvarkarastis)) {
            return;
        }
        $this->instruktoriaus_tvarkarascio_egzaminas[] = $tvarkarastis;
    }

    public function getPavadinimas(){
        return 'Adresas: '.$this->adresas.', Laikas: '.$this->data->format('Y-m-d H:m');
    }



}

