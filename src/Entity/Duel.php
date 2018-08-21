<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DuelRepository")
 */
class Duel
{    
    const DUEL_POULE = 'PO';
    const DUEL_HUITIEME = '8F';
    const DUEL_QUART = '4F';
    const DUEL_DEMI = '2F';
    const DUEL_FINALE = '1F';
        
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $horaire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score_equipe1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score_equipe2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competition", inversedBy="duels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competition;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeDuel", inversedBy="duels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeduel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe", inversedBy="duels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipe1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe", inversedBy="duels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipe2;

    public function getId()
    {
        return $this->id;
    }

    public function getHoraire(): ?\DateTimeInterface
    {
        return $this->horaire;
    }

    public function setHoraire(?\DateTimeInterface $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }

    public function getScoreEquipe1(): ?int
    {
        return $this->score_equipe1;
    }

    public function setScoreEquipe1(?int $score_equipe1): self
    {
        $this->score_equipe1 = $score_equipe1;

        return $this;
    }

    public function getScoreEquipe2(): ?int
    {
        return $this->score_equipe2;
    }

    public function setScoreEquipe2(?int $score_equipe2): self
    {
        $this->score_equipe2 = $score_equipe2;

        return $this;
    }
    
    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): self
    {
        $this->competition = $competition;

        return $this;
    }

    public function getTypeduel(): ?TypeDuel
    {
        return $this->typeduel;
    }

    public function setTypeduel(?TypeDuel $typeduel): self
    {
        $this->typeduel = $typeduel;

        return $this;
    }

    public function getEquipe1(): ?Equipe
    {
        return $this->equipe1;
    }

    public function setEquipe1(?Equipe $equipe1): self
    {
        $this->equipe1 = $equipe1;

        return $this;
    }

    public function getEquipe2(): ?Equipe
    {
        return $this->equipe2;
    }

    public function setEquipe2(?Equipe $equipe2): self
    {
        $this->equipe2 = $equipe2;

        return $this;
    }
}
