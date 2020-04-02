<?php
/**
 * Curl helper to core requests.
 *
 * Helper enabling communication with the casino nucleus, it performs all operations
 * on the network after the end of the game.
 *
 * @category   Helpers
 * @package    App\NetworkHelper\Core
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\NetworkHelper\DataStore;

use App\Model\DTO\Network\NetworkRequestInterface;
use App\Model\DTO\Network\NetworkResponseInterface;
use App\NetworkHelper\AbstractNetworkHelper;

/**
 * A class that provides access methods to casino action.
 * @category   NetworkHelper
 * @package    App\NetworkHelper\Core
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  03.2020 Raspberry Vision
 */
class DataStoreHelper extends AbstractNetworkHelper
{
    /**
     * DataStoreHelper constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'loterioma_datastore_helper',
            'http://api',
            80
        );
    }

    /**
     * The method that sends a request to save the user provided as a parameter.
     * @param NetworkRequestInterface $networkRequest
     * @return NetworkResponseInterface
     */
    public function storeUser(NetworkRequestInterface $networkRequest): NetworkResponseInterface
    {
        return $this->makeRequest($networkRequest);
    }

    /**
     * The method used to retrieve the user's object based on the criteria provided.
     * @param NetworkRequestInterface $networkRequest
     * @return NetworkResponseInterface
     */
    public function fetchUser(NetworkRequestInterface $networkRequest): NetworkResponseInterface
    {
        return $this->makeRequest($networkRequest);
    }
}