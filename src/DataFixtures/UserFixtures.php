<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserWallet;
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
        foreach ($this->getData() as $item) {
            $user = new User();
            $user->setEmail($item['email'])
                ->setPassword($this->passwordEncoder->encodePassword($user, $item['password']))
                ->setSuid($item['suid'])
                ->setWallet(new UserWallet($item['amount']));

            $manager->persist($user);
        }

        $manager->flush();
    }

    private function getData()
    {
        return [
            [
                'email' => 'email1@o2.pl',
                'password' => '123456',
                'suid' => '870ff240-6c4a-4760-ae22-ac08feb40bd5',
                'amount' => 1000,
            ],
            [
                'email' => 'email2@o2.pl',
                'password' => '123456',
                'suid' => '7f40c0f6-1e15-4d1a-8310-da99abb61742',
                'amount' => 1000,
            ],
            [
                'email' => 'email3@o2.pl',
                'password' => '123456',
                'suid' => '23bec26f-a64d-4d93-be1a-5c204a168333',
                'amount' => 1000,
            ],
        ];
    }
}
