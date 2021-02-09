<?php

namespace App\Controller\Web;

use App\Entity\DiceRound;
use App\Entity\Game;
use App\NetworkHelper\DataStore\DataStoreHelper;
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
            ->setResults($data['result']);

        $entityManager->persist($round);
        $entityManager->flush();

        return $this->json([
            'data' => $round->getId()
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
