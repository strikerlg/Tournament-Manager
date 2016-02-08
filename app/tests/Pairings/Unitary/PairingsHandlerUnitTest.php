<?php

use App\Utils\PairingsHandler\PairingsHandler;

/**
 * Tests is the pairings util class works
 * correctly.
 */
class PairingsHandlerUnitTest extends TestCase
{
    /**
     * @var PairingsHandler
     */
    protected $pairingsHandler;

    /**
     * Setup method.
     */
    public function setup()
    {
        parent::setup();
        $this->pairingsHandler = new PairingsHandler();
    }

    /**
     * Basic is working test.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests if the pairings array returns
     * the correct pairings count.
     */
    public function testPairingsCorrectArrayReturned()
    {
        $tournamentID = 1;
        $fakePlayers = [0 => getFakePlayers(11)];
        $expectedPairingsCount = 6;

        \Swiss::shouldReceive('roundsCount')
            ->with($tournamentID)
            ->once()
            ->andReturn(1);

        $result = $this->pairingsHandler->ranked(
            $fakePlayers,
            $tournamentID
        );
        $this->assertCount(6, $result);
    }
}

