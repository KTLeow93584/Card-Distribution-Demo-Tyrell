<?php

namespace Tests\Feature;

use App\Services\CardDistributorBaseService;
use PHPUnit\Framework\TestCase;

class CardDistributionTest extends TestCase
{
    public function test_distribute_to_4_people()
    {
        $service = new CardDistributorBaseService();
        $result = $service->distribute(4);

        $totalCards = array_reduce($result, fn($carry, $line) => $carry + count(explode(',', $line)), 0);
        $this->assertEquals(52, $totalCards);
        $this->assertCount(4, $result);
    }
}