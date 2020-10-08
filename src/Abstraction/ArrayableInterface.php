<?php declare(strict_types=1);

namespace App\Abstraction;

/**
 * Interface ArrayableInterface
 * @package BracketGenerator\Abstraction
 */
interface ArrayableInterface
{
    /**
     * @return array
     */
    public function toArray(): array;
}
