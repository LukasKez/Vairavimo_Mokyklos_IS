<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass="App\Repository\PavaruDezeRepository")
 */
class PavaruDeze
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
     * @ORM\OneToMany(targetEntity="App\Entity\TransportoPriemone", mappedBy="pavaru_deze")
     */
    private $transporto_priemones;
	
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


    public function __construct()
    {
        $this->transporto_priemones = new ArrayCollection();
    }
	
    /**
     * @return Collection|TransportoPriemone[]
     */
    public function getTransportoPriemones(): Collection
    {
        return $this->transporto_priemones;
    }
}