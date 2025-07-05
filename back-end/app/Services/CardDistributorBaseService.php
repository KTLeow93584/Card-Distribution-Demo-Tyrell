<?php

namespace App\Services;

use App\Interfaces\CardDistributorInterface;
use Exception;

class CardDistributorBaseService implements CardDistributorInterface
{
    /**
     * Distributes a 52-card deck to a given number of people.
     *
     * @param int $people Number of people to distribute cards to.
     * @return array List of formatted strings for each person’s cards.
     *
     * @throws Exception On any irregular condition.
     */
    public function distribute(int $people): array
    {
        if ($people <= 0) {
            throw new Exception('Invalid number of people');
        }

        $suits = ['S', 'H', 'D', 'C'];
        $ranks = [
            1 => 'A', 
            2, 3, 4, 5, 6, 7, 8, 9, 
            10 => 'X', 
            11 => 'J', 
            12 => 'Q', 
            13 => 'K'];

        $deck = [];

        foreach ($suits as $suit) {
            for ($i = 1; $i <= 13; $i++) {
                $value = $ranks[$i] ?? $i;
                $deck[] = "$suit-$value";
            }
        }

        // Reference: https://www.php.net/manual/en/function.shuffle.php
        shuffle($deck);

        $result = array_fill(0, $people, []);

        foreach ($deck as $i => $card) {
            $result[$i % $people][] = $card;
        }

        return array_map(fn($cards) => implode(',', $cards), $result);
    }
}
