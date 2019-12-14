<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InstruktoriausTvarkarastisRepository")
 */
class InstruktoriausTvarkarastis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $pradzia;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $pabaiga;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPradzia(): ?\DateTimeInterface
    {
        return $this->pradzia;
    }

    public function setPradzia(\DateTimeInterface $pradzia): self
    {
        $this->pradzia = $pradzia;

        return $this;
    }

    public function getPabaiga(): ?\DateTimeInterface
    {
        return $this->pabaiga;
    }

    public function setPabaiga(?\DateTimeInterface $pabaiga): self
    {
        $this->pabaiga = $pabaiga;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Instruktorius", inversedBy="tvarkarasciai")
     * @ORM\JoinColumn(name="instruktorius", referencedColumnName="id")
     */
    private $instruktorius;

    public function getInstruktorius(): ?Instruktorius
    {
        return $this->instruktorius;
    }

    public function setInstruktorius(?Instruktorius $instruktorius): self
    {
        $this->instruktorius = $instruktorius;

        return $this;
    }

}
