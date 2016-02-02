<?php

namespace Tests\Swiss\Unitary;

class SwissServiceUnitTest extends \TestCase
{
    /**
     * Basic is working test.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests if the pairings function
     * works properly with simple 
     * pairings(no bye).
     */
    public function testServicePairingsSimplePairingsReturned()
    {
        $numberOfPlayers = 10;
        $tournamentID = 1;

        $fakePlayers = getFakePlayers(10);
        $fakeStaticMatch = m::mock(
            'App\\Models\\Match'
        );

        $this->fakePlayersService
            ->shouldReceive('getPlayers')
            ->with($tournamentID)
            ->once()
            ->andReturn($fakePlayers);
        $this->fakeMatchesService
            ->shouldReceive('addMatch')
            ->withArgs([
                
            ])
            ->times($numberOfPlayers / 2)
            ->andReturnNull($fakeStaticMatch);
        $pairings = $this->service->pairings($tournamentID);
        $this->assertInternalType(
            'array',
            $pairings
        );
        $this->assertCount(5, $pairings);
    }
}

