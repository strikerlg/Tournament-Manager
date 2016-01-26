<?php

namespace Tests\Matches\Integration;

use App\Models\Match;
use Laracasts\TestDummy\Factory;

/**
 * Class used to test the Matches repo tests.
 */
class MatchesRepoIntegrationTest extends \TestCase
{
    /**
     * @var IMatchesRepository
     */
    private $repo;

    /**
     * Setup method
     */
    public function setup()
    {
        parent::setup();
        $this->repo = $this->app->make(
            'App\\Repositories\\Matches\\IMatchesRepository'
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
     * Basic is working test.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests if the addMatch works correclty.
     */
    public function testRepoAddMatchAdditionSuccess()
    {
        $admin = Factory::create('App\\Models\\Administrator');
        $tournament = Factory::create('App\\Models\\Tournament');
        $firstPlayer = Factory::create('App\\Models\\Player');
        $secondPlayer = Factory::create('App\\Models\\Player');
        $begin = \Carbon\Carbon::now();
        $finish = \Carbon\Carbon::tomorrow();

        $match = $this->repo->addMatch(
            $admin,
            $tournament,
            $firstPlayer,
            $secondPlayer,
            $begin,
            $finish
        );

        $this->assertInstanceOf(
            'App\\Models\\Match',
            $match
        );

        $this->seeInDatabase('matches', [
            'id' => $match->id,
            'tournament_id' => $tournament->id,
            'first_player_id' => $firstPlayer->id,
            'second_player_id' => $secondPlayer->id,
            'begin' => $begin,
            'finish' => $finish,
            'created_by' => $admin->id,
        ]);
    }

    /**
     * Tests if the update match on the repo
     * works correctly.
     */
    public function testUpdateMatchUpdateSuccess()
    {
        $match = Factory::create('App\\Models\\Match');
        $newPlayer = Factory::create('App\\Models\\Player');
        $newSecondPlayer = Factory::create('App\\Models\\Player');
        $winner = $newPlayer;
        $ended = true;
        $newBegin = \Carbon\Carbon::yesterday();
        $newFinish = \Carbon\Carbon::tomorrow();

        $match = $this->repo->updateMatch(
            $match->created_by,
            $match->id,
            $newPlayer,
            $newSecondPlayer,
            $winner,
            $newBegin,
            $newFinish,
            $ended
        );

        $this->assertEquals(
            $match->firstPlayer->id,
            $newPlayer->id
        );
        $this->assertEquals(
            $match->secondPlayer->id,
            $newSecondPlayer->id
        );
        $this->assertEquals(
            $match->winner->id,
            $winner->id
        );
        $this->assertEquals(
            $match->begin,
            $newBegin
        );
        $this->assertEquals(
            $match->finish,
            $newFinish
        );
        $this->assertEquals(
            $match->has_ended,
            $ended
        );
    }

    /**
     * Tests if the update throws a model not
     * found exception when an wrong id
     * is passed.
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testUpdateMatchUpdateFailure()
    {
        $this->repo->updateMatch(
            Factory::create('App\\Models\\Administrator'),
            23
        );
    }

    /**
     * Tests if the remove match on the repo
     * works correclty.
     */
    public function testRemoveMatchRemovalSuccess()
    {
        $match = Factory::create('App\\Models\\Match');
        $result = $this->repo->removeMatch(
            $match->created_by,
            $match->id
        );
        $this->assertTrue($result);
        $this->assertNull(
            Match::find($match->id)
        );
    }

    /**
     * Tests if the remove match on the repo
     * Throws a model not found exception
     * if we pass an invalid match id.
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testRemoveMatchRemovalFailure()
    {
        $this->repo->removeMatch(
            Factory::create('App\\Models\\Administrator'),
            123
        );
    }
}

