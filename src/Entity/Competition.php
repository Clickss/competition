<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetitionRepository")
 */
class Competition
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Groupe", mappedBy="competition", orphanRemoval=true)
     */
    private $groupes;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Groupe", mappedBy="competition")
     */
    private $typeduels;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->typeduels = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    
    /**
     * @return Collection|TypeDuel[]
     */
    public function getTypeDuels(): Collection
    {
        return $this->typeduels;
    }

    public function addTypeDuels(TypeDuel $typeduel): self
    {
        if (!$this->typeduels->contains($typeduel)) {
            $this->typeduels[] = $typeduel;
            $typeduel->setCompetition($this);
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->setCompetition($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            // set the owning side to null (unless already changed)
            if ($groupe->getCompetition() === $this) {
                $groupe->setCompetition(null);
            }
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->nom;
    }
}
