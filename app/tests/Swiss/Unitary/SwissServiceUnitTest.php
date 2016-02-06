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
     * Tests if the roundsCount method returns
     * the expected number.
     */
    public function testServiceRoundsCountCorrectValueReturned()
    {
        $tournamentID = 1;
        $playersCount = 33;
        $expectedRoundsCount = 5;

        $this->fakePlayersService
            ->shouldReceive('getPlayersCount')
            ->with($tournamentID)
            ->andReturn($playersCount);
        $result = $this->service->roundsCount($tournamentID);
        $this->assertEquals(
            $result,
            $expectedRoundsCount
        );
    }

    /**
     * Tests if the pairings function
     * works properly with simple 
     * pairings(no bye).
     */
    public function testServicePairingsPairingsReturned()
    {
        $numberOfPlayers = 18;
        $tournamentID = 1;

        $fakeRankedPlayers = [
            0 => getFakePlayers(9),
            1 => getFakePlayers(4),
            2 => getFakePlayers(5),
            3 => getFakePlayers(3),
        ];
        $expectedMatchesCount = 12;

        $fakeStaticMatch = m::mock(
            'App\\Models\\Match'
        );
        $this->fakePlayersService
            ->shouldReceive('getPlayersCount')
            ->with($tournamentID)
            ->once()
            ->andReturn($numberOfPlayers);
        $this->fakePlayersService
            ->shouldReceive('getRankedPlayers')
            ->with($tournamentID)
            ->once()
            ->andReturn($fakeRankedPlayers);
        $this->fakeMatchesService
            ->shouldReceive('addMatch')
            ->withArgs([
                m::type('int'),
                m::type('int'),
                m::type('int'),
                m::type('\Carbon\Carbon'),
                m::type('\Carbon\Carbon'),
            ])
            ->times($expectedMatchesCount) 
            ->andReturn($fakeStaticMatch);
        $pairings = $this->service->pairings($tournamentID);
        $this->assertInternalType(
            'array',
            $pairings
        );
        $this->assertCount($expectedMatchesCount, $pairings);
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
        $fakePlayers = [
            0 => getFakePlayers($numberOfPlayers),
        ];
        $this->fakePlayersService
            ->shouldReceive('getPlayersCount')
            ->once()
            ->andReturn($numberOfPlayers);
        $this->fakePlayersService
            ->shouldReceive('getRankedPlayers')
            ->andReturn($fakePlayers);
        $this->fakeMatchesService
            ->shouldReceive('addMatch')
            ->times($numberOfMatches)
            ->andReturn($fakeStaticMatch);
        $this->service->pairings(1);
    }
}

