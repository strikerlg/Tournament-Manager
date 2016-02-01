<?php

namespace Tests\Matches\Unitary;

use \Mockery as m;
use App\Services\Matches\MatchesService;

class MatchesServiceUnitTest extends \TestCase
{
    /**
     * @var MathcesService
     */
    protected $service;

    /**
     * @var Mockery
     */
    protected $fakeMatchesRepo;

    /**
     * @var Mockery
     */
    protected $fakeTournamentsRepo;

    /**
     * @var Mockery
     */
    protected $fakePlayersRepo;

    /**
     * Setup Method.
     */
    public function setup()
    {
        parent::setup();
        
        $this->fakeMatchesRepo = m::mock(
            'App\\Repositories\\Matches\\IMatchesRepository'
        );
        $this->fakeTournamentsRepo = m::mock(
            'App\\Repositories\\Tournaments\\ITournamentsRepository'
        );
        $this->fakePlayersRepo = m::mock(
            'App\\Repositories\\Players\\IPlayersRepository'
        );
        $this->service = new MatchesService(
            $this->fakeMatchesRepo,
            $this->fakeTournamentsRepo,
            $this->fakePlayersRepo
        );
    }

    /**
     * Test is working.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests if the Add match works
     * with the right interactions.
     */
    public function testServiceAddMatchCorrectInteractions()
    {
        $tournamentID = 1;
        $firstUserID = 1;
        $secondUserID = 2;
        $firstFakePlayer = m::mock(
            'App\\Models\\Player'
        );
        $secondFakePlayer = m::mock(
            'App\\Models\\Player'
        );
        $fakeTournament = m::mock(
            'App\\Models\\Tournament'
        );
        $fakeAdmin = m::mock(
            'App\\Models\\Administrator'
        );
        $fakeMatch = m::mock(
            'App\\Models\\Match'
        );

        \Admin::shouldReceive('getLogged')
            ->once()
            ->andReturn($fakeAdmin);
        $this->fakeTournamentsRepo
            ->shouldReceive('getTournament')
            ->with($tournamentID)
            ->once()
            ->andReturn($fakeTournament);
        $this->fakePlayersRepo
            ->shouldReceive([
                'getPlayer' => $firstFakePlayer,
                'getPlayer' => $secondFakePlayer,
            ])
            ->withArgs([
                m::type('App\\Models\\Tournament'),
                m::type('int'),
            ])
            ->twice();
        $this->fakeMatchesRepo
            ->shouldReceive('addMatch')
            ->withArgs([
                m::type('App\\Models\\Administrator'),
                m::type('App\\Models\\Tournament'),
                m::type('App\\Models\\Player'),
                m::type('App\\Models\\Player'),
                m::type('\Carbon\Carbon'),
                m::type('\Carbon\Carbon'),
            ])
            ->once()
            ->andReturn($fakeMatch);
        $match = $this->service->addMatch(
            $tournamentID,
            $firstUserID,
            $secondUserID,
            \Carbon\Carbon::now(),
            \Carbon\Carbon::tomorrow()
        );
        $this->assertEquals(
            $match,
            $fakeMatch
        );
    }

    /**
     * Tests if the update Match method
     * Interacts and works as expected.
     */
    public function testServiceUpdateMatchInteractsCorreclty()
    {
        $matchID = 1;
        $tournamentID = 1;
        $winnerID = 2;
        $hasEnded = true;

        $fakeAdmin = m::mock(
            'App\\Models\\Administrator'
        );
        $fakeMatch = m::mock(
            'App\\Models\\Match'
        );
        $fakeTournament = m::mock(
            'App\\Models\\Tournament'
        );
        $fakeWinner = m::mock(
            'App\\Models\\Player'
        );

        \Admin::shouldReceive('getLogged')
            ->once()
            ->andReturn($fakeAdmin);
        $this->fakePlayersRepo
            ->shouldReceive('getPlayer')
            ->once()
            ->andReturn($fakeWinner);
        $this->fakeMatchesRepo
            ->shouldReceive('updateMatch')
            ->withArgs([
                m::type('App\\Models\\Administrator'),
                $matchID,
                m::any(),
                m::any(),
                m::type('App\\Models\\Player'),
                m::any(),
                m::any(),
                $hasEnded,
            ])
            ->once()
            ->andReturn($fakeMatch);
        $match = $this->service->updateMatch(
            $matchID,
            null,
            null,
            $fakeWinner,
            null,
            null,
            $hasEnded
        );
        $this->assertEquals($match, $fakeMatch);
    }

    /**
     * Tests if the delete match method
     * Interacts and works as expected.
     */
    public function testServiceRemoveMatchInteractsCorrectly()
    {
        $matchID = 1;
        $fakeAdmin = m::mock(
            'App\\Models\\Administrator'
        );
        \Admin::shouldReceive('getLogged')
            ->once()
            ->andReturn($fakeAdmin);
        $this->fakeMatchesRepo
            ->shouldReceive('removeMatch')
            ->withArgs([
                m::type('App\\Models\\Administrator'),
                $matchID,
            ])
            ->once()
            ->andReturn(true);
        $result = $this->service->removeMatch($matchID);
        $this->assertTrue($result);
    }
}

