<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    const TYPE_DICE = 1;
    const TYPE_SLOTS = 2;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity=GeneratorConfig::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $generatorConfig;

    /**
     * @ORM\OneToMany(targetEntity=GameSession::class, mappedBy="game")
     */
    private $sessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getGeneratorConfig(): ?GeneratorConfig
    {
        return $this->generatorConfig;
    }

    public function setGeneratorConfig(GeneratorConfig $generatorConfig): self
    {
        $this->generatorConfig = $generatorConfig;

        return $this;
    }

    /**
     * @return Collection|GameSession[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(GameSession $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setGame($this);
        }

        return $this;
    }

    public function removeSession(GameSession $session): self
    {
        if ($this->sessions->contains($session)) {
            $this->sessions->removeElement($session);
            // set the owning side to null (unless already changed)
            if ($session->getGame() === $this) {
                $session->setGame(null);
            }
        }

        return $this;
    }
}
