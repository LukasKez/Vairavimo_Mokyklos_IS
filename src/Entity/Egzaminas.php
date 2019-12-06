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
     * @ORM\Column(type="date")
     */
    private $data;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $laikas;

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

    public function getLaikas(): ?string
    {
        return $this->laikas;
    }

    public function setLaikas(string $laikas): self
    {
        $this->laikas = $laikas;

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

    public function getEgzaminoTipas(): ?EgzaminuTipai
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



    public function __construct()
    {
        $this->laikomi_egzaminai = new ArrayCollection();
    }

    /**
     * @return Collection|LaikomasEgzaminas[]
     */
    public function getLaikomiEgzaminai(): Collection
    {
        return $this->laikomi_egzaminai;
    }


}

