<?php

namespace App\Controller\Web;

use App\NetworkHelper\DataStore\DataStoreHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="web_game_index")
     */
    public function index(DataStoreHelper $dataStoreHelper)
    {
        return $this->render('game/index.html.twig', [
            'games' => $dataStoreHelper->fetchGames()->getBody()
        ]);
    }
}
