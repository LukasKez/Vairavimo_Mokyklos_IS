<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KlientoTvarkarastisRepository")
 */
class KlientoTvarkarastis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $pradzia;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $pabaiga;

    /**
     * @ORM\Column(type="integer")
     */
    private $vairavimu_skaicius;

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

    public function setPabaiga(\DateTimeInterface $pabaiga): self
    {
        $this->pabaiga = $pabaiga;

        return $this;
    }

    public function getVairavimuSkaicius(): ?int
    {
        return $this->vairavimu_skaicius;
    }

    public function setVairavimuSkaicius(int $vairavimu_skaicius): self
    {
        $this->vairavimu_skaicius = $vairavimu_skaicius;

        return $this;
    }


}
