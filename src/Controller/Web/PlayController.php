<?php

namespace App\Controller\Web;

use App\Entity\DiceRound;
use App\Entity\Game;
use App\Entity\GameSession;
use App\NetworkHelper\DataStore\DataStoreHelper;
use App\Repository\DiceRoundRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/play")
 */
class PlayController extends AbstractController
{
    /**
     * @Route("/backend", name="web_play_backend")
     */
    public function backend(Request $request, EntityManagerInterface $entityManager)
    {
        $data = json_decode($request->getContent(), true);

        $round = new DiceRound();
        $round->setBets([])
            ->setMatched($data['matched'])
            ->setResults($data['result'])
            ->setUser($this->getUser());

        $entityManager->persist($round);
        $entityManager->flush();

        return $this->json([
            'data' => $round->getId()
        ]);
    }

    /**
     * @Route("/history", name="web_play_history")
     */
    public function history(Request $request, DiceRoundRepository $repository)
    {
        return $this->render('play/history.html.twig', [
            'rounds' => $repository->findBy(['user' => $this->getUser()])
        ]);
    }

    /**
     * @Route("/bank", name="web_play_bank")
     */
    public function bank(Request $request)
    {
        if ($request->get('action') === 'pay-out') {
            return $this->json([
                'sessionId' => -1
            ]);
        }

        return $this->json([
            'sessionId' => 1,
            'amount' => 1000
        ]);
    }

    /**
     * @Route("/cashier/{id}", name="web_play_cashier")
     */
    public function cashier(Request $request, EntityManagerInterface $entityManager, Game $game)
    {
        if ($request->get('action') === 'pay-out') {
            return $this->json([
                'sessionId' => -1
            ]);
        }

        $session = new GameSession();
        $session->setUser($this->getUser())
            ->setAmount(100)
            ->setToken(uniqid())
            ->setGame($game)
            ->setCreatedAt(new \DateTime());

        $entityManager->persist($session);
        $entityManager->flush();

        return $this->json([
            'sessionId' => $session->getToken(),
            'amount' => 1000
        ]);
    }

    /**
     * @Route("/{id}", name="web_play_index")
     */
    public function index(Game $game)
    {
        return $this->render('play/index.html.twig', [
            'game' => $game
        ]);
    }
}
