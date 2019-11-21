<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MiestasRepository")
 */
class Miestas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $pavadinimas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Filialas", mappedBy="miestas")
     */
    private $filialai;

    public function __construct()
    {
        $this->filialai = new ArrayCollection();
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
     * @return Collection|Filialas[]
     */
    public function getFilialai(): Collection
    {
        return $this->filialai;
    }

    public function addFilialai(Filialas $filialai): self
    {
        if (!$this->filialai->contains($filialai)) {
            $this->filialai[] = $filialai;
            $filialai->setMiestas($this);
        }

        return $this;
    }

    public function removeFilialai(Filialas $filialai): self
    {
        if ($this->filialai->contains($filialai)) {
            $this->filialai->removeElement($filialai);
            // set the owning side to null (unless already changed)
            if ($filialai->getMiestas() === $this) {
                $filialai->setMiestas(null);
            }
        }

        return $this;
    }
}
