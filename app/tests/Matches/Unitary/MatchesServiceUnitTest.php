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
            'App\\Repositories\\Players\\IPlayerRepository'
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
            ->with(m::type('integer'))
            ->twice();
        $this->fakeMatchesRepo
            ->shouldReceive('addMatch')
            ->with([
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
}

