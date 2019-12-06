<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Table(name="egzaminu_tipai")
 * @ORM\Entity(repositoryClass="App\Repository\EgzaminuTipaiRepository")
 */
class EgzaminuTipai
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
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Egzaminas", mappedBy="fk_tipas")
     */
    private $egzaminai;

    public function __construct()
    {
        $this->egzaminai = new ArrayCollection();
    }

    /**
     * @return Collection|Egzaminas[]
     */
    public function getEgzaminai(): Collection
    {
        return $this->egzaminai;
    }
}
