<?php

namespace App\Controller\Web;

use App\Entity\Game;
use App\NetworkHelper\DataStore\DataStoreHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/play")
 */
class PlayController extends AbstractController
{
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
