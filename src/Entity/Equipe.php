<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipeRepository")
 */
class Equipe
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
     * @ORM\Column(type="string", length=255)
     */
    private $pays;
    
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $pays_initial;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Groupe", mappedBy="equipes")
     */
    private $groupes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Duel", mappedBy="equipe1")
     */
    private $duels;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->duels = new ArrayCollection();
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

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }
    
    public function getPaysInitial(): ?string
    {
        return $this->pays_initial;
    }

    public function setPaysInitial(string $pays_initial): self
    {
        $this->pays_initial = $pays_initial;

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
            $this->groupes[] = $groupes;
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
        }

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
            $duel->setEquipe1($this);
        }

        return $this;
    }

    public function removeDuel(Duel $duel): self
    {
        if ($this->duels->contains($duel)) {
            $this->duels->removeElement($duel);
            // set the owning side to null (unless already changed)
            if ($duel->getEquipe1() === $this) {
                $duel->setEquipe1(null);
            }
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->nom;
    }
}
