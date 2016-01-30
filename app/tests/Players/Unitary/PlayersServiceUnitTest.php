<?php

namespace Tests\Players\Unitary;

use \Mockery as m;
use App\Services\Players\PlayersService;

class PlayersServiceUnitTest extends \TestCase
{
    /**
     * @var PlayersService
     */
    private $service;

    /**
     * @var Mockery
     */
    private $fakeUsersRepo;

    /**
     * @var Mockery
     */
    private $fakePlayersRepo;

    /**
     * @var Mockery
     */
    private $fakeTournamentsRepo;

    /**
     * Setup method.
     */
    public function setup()
    {
        parent::setup();

        $this->fakeUsersRepo = m::mock(
            'App\\Repositories\\Users\\IUsersRepository'
        );
        $this->fakePlayersRepo = m::mock(
            'App\\Repositories\\Players\\IPlayersRepository'
        );
        $this->fakeTournamentsRepo = m::mock(
            'App\\Repositories\\Tournaments\\ITournamentsRepository'
        );
        $this->service = new PlayersService(
            $this->fakeUsersRepo,
            $this->fakePlayersRepo,
            $this->fakeTournamentsRepo
        );
    }

    /**
     * Teardown method.
     */
    public function teardown()
    {
        $this->service = null;
        $this->fakeUsersRepo = null;
        $this->fakePlayersRepo = null;

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
     * Tests if the service add Player calls
     * the players repo AddPlayer method.
     */
    public function testAddPlayerWithExpectedMethodFlow()
    {
        $userID = 1;
        $fakeUser = m::mock(
            'App\\Models\\User'
        );
        $fakePlayer = m::mock(
            'App\\Models\\Player'
        );
        $this->fakeUsersRepo
            ->shouldReceive('getUser')
            ->with($userID)
            ->once()
            ->andReturn($fakeUser);
        $this->fakePlayersRepo
            ->shouldReceive('addPlayer')
            ->withArgs(
                array(
                    m::type('App\\Models\\User'), 
                    'nickname',
                )
            )
            ->once()
            ->andReturn($fakePlayer);
        $player = $this->service->addPlayer(
            $userID,
            'nickname'
        );
        $this->assertEquals(
            $player, 
            $fakePlayer
        );
    }

    /**
     * Tests the GetCount method on the Players
     * service for a given Tournament.
     */
    public function testServiceGetCountWithExpectedMethodFlow()
    {
        $count = 10;
        $tournamentID = 1;
        $fakeTournament = m::mock(
            'App\\Models\\Tournament'
        );
        $this->fakeTournamentsRepo
            ->shouldReceive('getTournament')
            ->withArgs(array($tournamentID))
            ->once()
            ->andReturn($fakeTournament);
        $this->fakePlayersRepo
            ->shouldReceive('getCount')
            ->withArgs(
                array(m::type('App\\Models\\Tournament'))
            )
            ->once()
            ->andReturn($count);
        $returnedCount = $this->service->getPlayersCount(
            $tournamentID
        );
        $this->assertEquals(
            $count,
            $returnedCount
        );
    }

    /**
     * Tests if the delete players method
     * interacts and works properly.
     */
    public function testServiceDeletePlayersWithExpectedMethodFlow()
    {
        $tournamentID = 1;
        $fakeTournament = m::mock(
            'App\\Models\\Tournament'
        );
        $this->fakeTournamentsRepo
            ->shouldReceive('getTournament')
            ->withArgs(
                array($tournamentID)
            )
            ->once()
            ->andReturn($fakeTournament);
        $this->fakePlayersRepo
            ->shouldReceive('deletePlayers')
            ->withArgs(
                array(m::type('App\\Models\\Tournament'))
            )
            ->once()
            ->andReturn(true);
        $result = $this->service->deletePlayers(
            $tournamentID
        );
        $this->assertTrue($result);
    }

    /**
     * Tests if the deletePlayer method
     * interacts and works as supposed.
     */
    public function testDeletePlayerWithExpectedMethodFlow()
    {
        $tournamentID = 1;
        $playerID = 1;
        $fakeTournament = m::mock(
            'App\\Models\\Tournament'
        );
        $this->fakeTournamentsRepo
            ->shouldReceive('getTournament')
            ->withArgs(array($tournamentID))
            ->once()
            ->andReturn($fakeTournament);
        $this->fakePlayersRepo
            ->shouldReceive('deletePlayer')
            ->withArgs(
                array(
                    m::type('App\\Models\\Tournament'),
                    $playerID
                )
            )
            ->andReturn(true);
        $result = $this->service->deletePlayer(
            $tournamentID,
            $playerID
        );
        $this->assertTrue($result);
    }
}

