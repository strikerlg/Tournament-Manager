<?php

namespace Tests\Tournaments\Unitary;

use \Mockery as m;
use App\Services\Tournaments\TournamentsService;

class TournamentsServiceUnitTest extends \TestCase
{
    /**
     * @var TournamentsService
     */
    protected $service;

    /**
     * @var ITournamentsRepository
     */
    protected $fakeTournamentsRepo;

    /**
     * Setup method.
     */
    public function setup()
    {
        parent::setup();
        $this->fakeTournamentsRepo = m::mock(
            'App\\Repositories\\Tournaments\\ITournamentsRepository'
        );
        $this->service = new TournamentsService(
            $this->fakeTournamentsRepo
        );
    }

    /**
     * Base is working test.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests if the service's add tournament
     * works as supposed.
     */
    public function testServiceAddTournamentRepoCalled()
    {
        $name = 'tournament name';
        $fakeTournament = m::mock(
            'App\\Models\\Tournament'
        );
        $this->fakeTournamentsRepo
            ->shouldReceive('addTournament')
            ->withArgs([
                // TODO: Add the admin type here.
                $name,
                m::type('\Carbon\Carbon'),
                m::type('\Carbon\Carbon'),
                false,
            ])
            ->once()
            ->andReturn($fakeTournament);
        $tournament = $this->service->addTournament(
            $name,
            Carbon::now(),
            Carbon::tomorrow(),
            false
        );
        $this->assertEquals(
            $tournament,
            $fakeTournament
        );
    }
}

