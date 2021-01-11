<?php

namespace App\Twig;

use App\Entity\Game;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class GameExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('game_type', [$this, 'getGameType']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            //new TwigFunction('function_name', [$this, 'doSomething']),
        ];
    }

    /**
     * Returns translated game type name.
     *
     * @param Game $game
     * @return string
     */
    public function getGameType(Game $game)
    {
        return sprintf('game.types.%s', $game->getType());
    }
}
