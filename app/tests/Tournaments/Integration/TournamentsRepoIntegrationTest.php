<?php

namespace Tests\Tournaments\Integration;

use App\Models\Tournament;
use Laracasts\TestDummy\Factory;

/**
 * Class used to test the Tournaments repo tests.
 */
class TournamentsRepoIntegrationTest extends \TestCase
{
    /**
     * @var ITournamentsRepository
     */
    private $repo;

    /**
     * Setup method
     */
    public function setup()
    {
        parent::setup();
        $this->repo = $this->app->make(
            'App\\Repositories\\Tournaments\\ITournamentsRepository'
        );
    }

    /**
     * Teardown method
     */
    public function teardown()
    {
        $this->repo = null;
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
        $tournament = $this->repo->addTournament(
            'tournament name',
            \Carbon\Carbon::now(),
            \Carbon\Carbon::now(),
            false,
            $admin
        );
        $this->assertNotNull($tournament);
        $this->assertInstanceOf(
            'App\\Models\\Tournament',
            $admin
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
        $tournament = $this->repo->updateTournament(
            $name,
            $beginDate,
            $finishDate,
            $has_ended
        );

        $this->assertNotEquals(
            $tournament->name, $name
        );
        $this->assertNotEquals(
            $tournament->begin, $beginDate
        );
        $this->assertNotEquals(
            $tournament->finish, $finishDate
        );
        $this->assertNotEquals(
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
        $result = $this->repo->removeTournament(
            $tournament->name
        );
        $this->assertTrue($result);
        $this->assertNull(
            Tournament::find($tournament->id)
        );
    }

    /**
     * Tests if the remove tournament throw a
     * ModelNotFoundException when an 
     * invalid name is passed.
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException;
     */
    public function testRepoRemoveTournamentRemovalFailure()
    {
        $this->repo->removeTournament(
            'non existent name'
        );
    }
}

