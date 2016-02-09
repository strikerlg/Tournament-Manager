<?php

namespace Tests\Tournaments\Integration;

use App\Models\Tournament;
use App\Models\Administrator;
use Laracasts\TestDummy\Factory;

/**
 * Class used to test the Tournaments repo tests.
 */
class TournamentsRepoIntegrationTest extends \TestCase
{
    /**
     * @var ITournamentsRepository
     */
    private $repository;

    /**
     * Setup method
     */
    public function setup()
    {
        parent::setup();
        $this->repository = $this->app->make(
            'App\\Repositories\\Tournaments\\ITournamentsRepository'
        );
    }

    /**
     * Teardown method
     */
    public function teardown()
    {
        $this->repository = null;
        parent::teardown();
    }

    /**
     * Is working test.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests the add tournament method.
     */
    public function testAddTournamentAdditionSuccess()
    {
        $admin = Factory::create('App\\Models\\Administrator');
        $tournament = $this->repository->addTournament(
            $admin,
            'tournament name',
            \Carbon\Carbon::now(),
            \Carbon\Carbon::now(),
            false
        );
        $this->assertNotNull($tournament);
        $this->assertInstanceOf(
            'App\\Models\\Tournament',
            $tournament
        );
        $this->seeInDatabase('tournaments', [
            'name' => $tournament->name,
            'begin' => $tournament->begin,
            'finish' => $tournament->finish,
            'has_ended' => $tournament->has_ended,
        ]);
    }

    /**
     * Tests the update tournament method.
     */
    public function testUpdateTournamentUpdateSuccess()
    {
        $name = 'testing name update';
        $beginDate = \Carbon\Carbon::yesterday();
        $finishDate = \Carbon\Carbon::tomorrow();
        $has_ended = true;

        $tournament = Factory::create('App\\Models\\Tournament');
        $tournament = $this->repository->updateTournament(
            Administrator::find($tournament->created_by),
            $tournament->name,
            $beginDate,
            $finishDate,
            $has_ended
        );

        $this->assertEquals(
            $tournament->begin, $beginDate
        );
        $this->assertEquals(
            $tournament->finish, $finishDate
        );
        $this->assertEquals(
            $tournament->has_ended, $has_ended
        );
    }

    /**
     * Tests if the remove tournament method
     * works as expected.
     */
    public function testRepoRemoveTournamentRemovalSuccess()
    {
        $tournament = Factory::create('App\\Models\\Tournament');

        $result = $this->repository->removeTournament(
            Administrator::find($tournament->created_by),
            $tournament->name
        );
        $this->assertTrue($result);
        $this->assertNull(
            Tournament::find($tournament->id)
        );
    }

    /**
     * Tests if the remove tournament throws a
     * ModelNotFoundException when an 
     * invalid name is passed.
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testRepoRemoveTournamentRemovalFailure()
    {
        $admin = Factory::create('App\\Models\\Administrator');
        $this->repository->removeTournament(
            $admin,
            'non existent name'
        );
    }

    /**
     * Tests if the update tournament throws a
     * ModelNotFoundException when an 
     * invalid name is passed.
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testRepoUpdateTournamentUpdateFailure()
    {
        $admin = Factory::create('App\\Models\\Administrator');
        $this->repository->updateTournament(
            $admin,
            'non existent name'
        );
    }

    /**
     * Tests if the attach player method
     * works correctly.
     */
    public function testRepoAttachPlayerPlayerAttached()
    {
        $player = Factory::create('App\\Models\\Player');
        $tournament = Factory::create('App\\Models\\Tournament');
        $admin = Administrator::find($tournament->created_by);

        $result = $this->repository->attachPlayer(
            $admin,
            $tournament->name,
            $player
        );
        $this->assertTrue($result);
        $this->seeInDatabase('tournaments_players', [
            'player_id' => $player->id,
            'tournament_id' => $tournament->id,
        ]);
    }

    /**
     * Tests if the dettach player method
     * works correctly.
     */
    public function testRepoDettachPlayerPlayerDettached()
    {
        $player = Factory::create('App\\Models\\Player');
        $tournament = Factory::create('App\\Models\\Tournament');
        $admin = Administrator::find($tournament->created_by);
        $this->repository->attachPlayer(
            $admin,
            $tournament->name,
            $player
        );

        $result = $this->repository->detachPlayer(
            $admin,
            $tournament->name,
            $player
        );
        $this->assertTrue($result);
        $this->assertCount(0, $tournament->players);
    }
}

