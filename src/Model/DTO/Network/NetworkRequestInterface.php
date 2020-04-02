<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.03.20
 * Time: 19:07
 */

namespace App\Model\DTO\Network;

interface NetworkRequestInterface
{
    public function getEndpoint(): string;

    public function getComponentHash(): string;

    public function getRequestParams(): array;

    public function getMethod(): string;
}