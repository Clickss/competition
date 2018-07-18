<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeDuelRepository")
 */
class TypeDuel
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
    private $type_duel;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_type_duel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Duel", mappedBy="typeduel")
     */
    private $duels;

    public function __construct()
    {
        $this->duels = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTypeDuel(): ?string
    {
        return $this->type_duel;
    }

    public function setTypeDuel(string $type_duel): self
    {
        $this->type_duel = $type_duel;

        return $this;
    }
    
    public function getCodeTypeDuel(): ?string
    {
        return $this->code_type_duel;
    }

    public function setCodeTypeDuel(string $code_type_duel): self
    {
        $this->code_type_duel = $code_type_duel;

        return $this;
    }

    /**
     * @return Collection|Duel[]
     */
    public function getDuels(): Collection
    {
        return $this->duels;
    }

    public function addDuel(Duel $duel): self
    {
        if (!$this->duels->contains($duel)) {
            $this->duels[] = $duel;
            $duel->setTypeduel($this);
        }

        return $this;
    }

    public function removeDuel(Duel $duel): self
    {
        if ($this->duels->contains($duel)) {
            $this->duels->removeElement($duel);
            // set the owning side to null (unless already changed)
            if ($duel->getTypeduel() === $this) {
                $duel->setTypeduel(null);
            }
        }

        return $this;
    }
    
    public function __toString(){
        return $this->type_duel;
    }
}
