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
     * Teardown method.
     */
    public function teardown()
    {
        $this->fakePlayersService = null;
        $this->fakeMatchesService = null;
        $this->service = null;

        parent::teardown();
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
            ->andReturn($fakeStaticMatch);
        $pairings = $this->service->pairings($tournamentID);
        $this->assertInternalType(
            'array',
            $pairings
        );
        $this->assertCount(5, $pairings);
    }

    /**
     * Tests if the pairings method generates
     * a bye match when an odd number of
     * players is provided.
     */
    public function testServicePairingsWithByeRegistered()
    {
        $numberOfPlayers = 11;
        $numberOfMatches = intval(
            floor($numberOfPlayers / 2) + $numberOfPlayers % 2
        );
        $fakeStaticMatch = m::mock(
            'App\\Models\\Match'
        );
        $fakePlayers = getFakePlayers($numberOfPlayers);
        $this->fakePlayersService
            ->shouldReceive('getPlayers')
            ->andReturn($fakePlayers);
        $this->fakeMatchesService
            ->shouldReceive('addMatch')
            //->times(
            ->times($numberOfMatches)
            ->andReturn($fakeStaticMatch);
        $this->service->pairings(1);
    }

    /**
     * Tests if the roundsCount method returns
     * the expected number.
     */
    public function testServiceRoundsCountCorrectValueReturned()
    {
        $this->markTestIncomplete('not written');
    }
}

