<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilialasRepository")
 */
class Filialas
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
    private $pavadinimas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefono_numeris;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Miestas", inversedBy="filialai")
     * @ORM\JoinColumn(nullable=false)
     */
    private $miestas;

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

    public function getAdresas(): ?string
    {
        return $this->adresas;
    }

    public function setAdresas(string $adresas): self
    {
        $this->adresas = $adresas;

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

    public function getMiestas(): ?Miestas
    {
        return $this->miestas;
    }

    public function setMiestas(?Miestas $miestas): self
    {
        $this->miestas = $miestas;

        return $this;
    }
}
