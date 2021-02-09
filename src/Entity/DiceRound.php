<?php

namespace App\Entity;

use App\Repository\DiceRoundRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiceRoundRepository::class)
 */
class DiceRound
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $bets = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $matched = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $results = [];

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="diceRounds")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBets(): ?array
    {
        return $this->bets;
    }

    public function setBets(array $bets): self
    {
        $this->bets = $bets;

        return $this;
    }

    public function getMatched(): ?array
    {
        return $this->matched;
    }

    public function setMatched(?array $matched): self
    {
        $this->matched = $matched;

        return $this;
    }

    public function getResults(): ?array
    {
        return $this->results;
    }

    public function setResults(?array $results): self
    {
        $this->results = $results;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
