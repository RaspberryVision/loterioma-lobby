<?php


namespace App\Handler;

use App\Entity\User;
use App\Message\UserWalletUpdated;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UserWalletHandler implements MessageHandlerInterface
{
    /** @var EntityManagerInterface $entityManager */
    private $entityManager;

    /**
     * UserWalletHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(UserWalletUpdated $message)
    {
        $data = json_decode($message->getContent(), true);

        $user = $this->entityManager->getRepository(User::class)->find($data['id']);
        $user->getWallet()->setAmount($data['amount']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}