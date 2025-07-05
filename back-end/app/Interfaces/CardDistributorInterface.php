<?php

namespace App\Interfaces;

/**
 * Contract for distributing cards.
 */
interface CardDistributorInterface
{
    /**
     * Distributes cards to the given number of people.
     *
     * @param int $people
     * @return array
     */
    public function distribute(int $people): array;
}