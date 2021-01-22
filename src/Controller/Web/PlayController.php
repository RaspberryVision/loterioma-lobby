<?php

namespace App\Controller\Web;

use App\Entity\Game;
use App\NetworkHelper\DataStore\DataStoreHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/{id}/backend", name="web_play_backend")
     */
    public function backend(Request $request, Game $game)
    {

    }
}
