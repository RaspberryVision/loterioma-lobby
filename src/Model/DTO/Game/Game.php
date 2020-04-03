<?php

namespace App\Model\DTO\Game;

use JsonSerializable;

class Game implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var int|null
     */
    private $type;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var GeneratorConfig
     */
    private $generatorConfig;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Game
     */
    public function setId(int $id): Game
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return Game
     */
    public function setType(int $type): Game
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Game
     */
    public function setName(string $name): Game
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Game
     */
    public function setDescription(?string $description): Game
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return GeneratorConfig
     */
    public function getGeneratorConfig(): ?GeneratorConfig
    {
        return $this->generatorConfig;
    }

    /**
     * @param GeneratorConfig $generatorConfig
     * @return Game
     */
    public function setGeneratorConfig(GeneratorConfig $generatorConfig): Game
    {
        $this->generatorConfig = $generatorConfig;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'generatorConfig' => [
                'seed' => $this->generatorConfig->getSeed(),
                'min' => $this->generatorConfig->getMin(),
                'max' => $this->generatorConfig->getMax(),
                'format' => [$this->generatorConfig->getFormat()],
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public function __set($name, $value): void
    {
        $this->$name = $value;
    }


}