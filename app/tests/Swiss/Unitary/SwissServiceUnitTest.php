<?php

namespace Tests\Swiss\Unitary;

use App\Services\Swiss\SwissService;
use \Mockery as m;

class SwissServiceUnitTest extends \TestCase
{
    /**
     * @var Mockery
     */
    protected $fakePlayersService;

    /**
     * @var Mockery
     */
    protected $fakeMatchesService;

    /**
     * @var SwissService
     */
    protected $service;

    /**
     * Setup method.
     */
    public function setup()
    {
        parent::setup();

        $this->fakePlayersService = m::mock(
            'App\\Services\\Players\\PlayersService'
        );
        $this->fakeMatchesService = m::mock(
            'App\\Services\\Matches\\MatchesService'
        );
        $this->service = new SwissService(
            $this->fakePlayersService,
            $this->fakeMatchesService
        );
    }

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
                m::type('int'),
                m::type('int'),
                m::type('int'),
                m::type('\Carbon\Carbon'),
                m::type('\Carbon\Carbon'),
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

