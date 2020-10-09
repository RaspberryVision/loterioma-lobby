<?php


namespace App\Handler\Game;


use App\Message\UserRegistration;
use App\Model\DTO\Network\NetworkRequest;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GameCreatedHandler  implements MessageHandlerInterface
{
    public function __invoke(UserRegistration $message)
    {

       var_dump('kozak');exit();
        // ... do some work - like sending an SMS message!
    }
}