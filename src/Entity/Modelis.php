<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModelisRepository")
 */
class Modelis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $pavadinimas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Marke", inversedBy="modelis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_marke;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModelis(): ?string
    {
        return $this->pavadinimas;
    }

    public function setModelis(string $pavadinimas): self
    {
        $this->pavadinimas = $pavadinimas;

        return $this;
    }

    public function getMarke(): ?Marke
    {
        return $this->fk_marke;
    }

    public function setMarke(?Marke $fk_marke): self
    {
        $this->fk_marke = $fk_marke;

        return $this;
    }

    public function getMarkeModelis(): ?string
    {
        return $this->fk_marke. " ".$this->pavadinimas;
    }

}
