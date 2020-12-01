<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\GeneratorConfig;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GameFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $game = new Game();
        $game->setName(1)
            ->setDescription(1)
            ->setType(1);

        $config = new GeneratorConfig();
        $config->setSeed(1)
            ->setMin(1)
            ->setMax(10)
            ->setFormat([1]);

        $game->setGeneratorConfig($config);
        // $product = new Product();
        // $manager->persist($product);

        $manager->persist($game);
        $manager->flush();
    }
}
