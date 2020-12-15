<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\GeneratorConfig;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface $passwordEncoder
     */
    private $passwordEncoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 15; $i++) {
            $user = new User();
            $user->setEmail('user' . $i . '@email.pl');
            $user->setPassword($this->passwordEncoder->encodePassword($user, '123456'));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
