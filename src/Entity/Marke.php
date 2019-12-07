<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MarkeRepository")
 */
class Marke
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
     * @ORM\OneToMany(targetEntity="App\Entity\Modelis", mappedBy="fk_marke")
     */
    private $modelis;

    public function __construct()
    {
        $this->modelis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPavadinimas(): ?string
    {
        return $this->pavadinimas;
    }

    public function setPavadinimas(string $pavadinimas): self
    {
        $this->pavadinimas = $pavadinimas;

        return $this;
    }

    /**
     * @return Collection|Modelis[]
     */
    public function getModelis(): Collection
    {
        return $this->modelis;
    }

    public function addModeli(Modelis $modeli): self
    {
        if (!$this->modelis->contains($modeli)) {
            $this->modelis[] = $modeli;
            $modeli->setFkMarke($this);
        }

        return $this;
    }

    public function removeModeli(Modelis $modeli): self
    {
        if ($this->modelis->contains($modeli)) {
            $this->modelis->removeElement($modeli);
            // set the owning side to null (unless already changed)
            if ($modeli->getFkMarke() === $this) {
                $modeli->setFkMarke(null);
            }
        }

        return $this;
    }
}
