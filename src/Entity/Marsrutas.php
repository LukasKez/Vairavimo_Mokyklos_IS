<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MarsrutasRepository")
 */
class Marsrutas
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
    private $nuoroda;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Filialas", inversedBy="marsrutas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Filialas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNuoroda(): ?string
    {
        return $this->nuoroda;
    }

    public function setNuoroda(string $nuoroda): self
    {
        $this->nuoroda = $nuoroda;

        return $this;
    }

    public function getFilialas(): ?Filialas
    {
        return $this->Filialas;
    }

    public function setFilialas(?Filialas $Filialas): self
    {
        $this->Filialas = $Filialas;

        return $this;
    }
}
