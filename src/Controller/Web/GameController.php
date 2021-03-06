<?php

namespace App\Controller\Web;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/games")
 */
class GameController extends AbstractController
{
    /**
     * @Route("", name="web_game_index")
     * @param GameRepository $gameRepository
     * @return Response
     */
    public function index(GameRepository $gameRepository)
    {
        return $this->render(
            'game/index.html.twig',
            [
                'games' => $gameRepository->findAll(),
            ]
        );
    }
}
