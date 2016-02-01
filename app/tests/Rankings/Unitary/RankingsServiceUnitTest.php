<?php

namespace Tests\Rankings\Unitary;

use App\Services\Rankings\RankingsService;
use \Mockery as m;

class RankingsServiceUnitTest extends \TestCase
{
    /**
     * @var RankingsService
     */
    protected $service;

    /**
     * @var Mockery
     */
    protected $fakeRankingsRepo;

    /**
     * @var Mockery
     */
    protected $fakePlayersRepo;

    /**
     * @var Mockery
     */
    protected $fakeTournamentsRepo;

    /**
     * Setup method.
     */
    public function setup()
    {
        parent::setup();
        $this->fakeRankingsRepo = m::mock(
            'App\\Repositories\\Rankings\\IRankingsRepository'
        );
        $this->fakePlayersRepo = m::mock(
            'App\\Repositories\\Players\\IPlayersRepository'
        );
        $this->fakeTournamentsRepo = m::mock(
            'App\\Repositories\\Tournaments\\ITournamentsRepository'
        );
        $this->service = new RankingsService(
            $this->fakeRankingsRepo,
            $this->fakePlayersRepo,
            $this->fakeTournamentsRepo
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
     * Tests if the addRanking has the
     * expected flow.
     */
    public function testServiceAddRankingCorrectInteractions()
    {
        $playerID = 1;
        $tournamentID = 1;
        $score = 0;

        // TODO: Add administrator fake instance.
        $fakeTournament = m::mock(
            'App\\Models\\Tournament'
        );
        $fakePlayer = m::mock(
            'App\\Models\\Player'
        );
        $fakeRanking = m::mock(
            'App\\Models\\Ranking'
        );

        $this->fakeTournamentsRepo
            ->shouldReceive('getTournament')
            ->with($tournamentID)
            ->once()
            ->andReturn($fakeTournament);
        $this->fakePlayersRepo
            ->shouldReceive('getPlayer')
            ->with($playerID)
            ->once()
            ->andReturn($fakePlayer);
        $this->fakeRankingsRepo
            ->shouldReceive('addRanking')
            ->withArgs([
                m::type('App\\Models\\Player'),
                m::type('App\\Models\\Tournament'),
                $score,
            ])
            ->once()
            ->andReturn($fakeRanking);
        $match = $this->service->addMatch(
            $tournamentID,
            $playerID,
            $score
        );
        $this->assertEquals(
            $match,
            $fakeMatch
        );
    }
}

