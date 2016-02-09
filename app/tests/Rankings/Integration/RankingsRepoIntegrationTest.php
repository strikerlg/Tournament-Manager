<?php

namespace Tests\Rankings\Integration;

use App\Models\Player;
use App\Models\Administrator;
use App\Models\Tournament;
use App\Models\Ranking;
use Laracasts\TestDummy\Factory;

/**
 * Class used to test the Rankings repo tests.
 */
class RankingsRepoIntegrationTest extends \TestCase
{
    /**
     * @var IRankingsRepository
     */
    private $repo;

    /**
     * Setup method
     */
    public function setup()
    {
        parent::setup();
        $this->repo = $this->app->make(
            'App\\Repositories\\Rankings\\IRankingsRepository'
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
    public function testIsWoking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests if the add rankings works 
     * correclty.
     */
    public function testRepoAddRankingAdditionSuccess()
    {
        $player = Factory::create('App\\Models\\Player');
        $tournament = Factory::create('App\\Models\\Tournament');
        $admin = Administrator::find($tournament->created_by);

        $ranking = $this->repo->addRanking(
            $admin,
            $player,
            $tournament,
            12
        );

        $this->assertNotNull(
            $ranking
        );
        $this->assertInstanceOf(
            'App\\Models\\Ranking',
            $ranking
        );

        $this->seeInDatabase(
            'rankings',
            [
                'id' => $ranking->id,
                'player_id' => $player->id,
                'tournament_id' => $tournament->id,
                'score' => 12,
            ]
        );
    }

    /**
     * Tests if the update rankings works 
     * correclty.
     */
    public function testRepoUpdateRankingsUpdateSuccess()
    {
        $ranking = Factory::create('App\\Models\\Ranking');
        $tournament = $ranking->tournament;
        $admin = Administrator::find($tournament->created_by);

        $ranking = $this->repo->updateRanking(
            $admin,
            $ranking->id,
            14,
            Tournament::find($ranking->tournament_id),
            Player::find($ranking->player_id)
        );
        $this->assertNotNull($ranking);
        $this->assertInstanceOf(
            'App\\Models\\Ranking',
            $ranking
        );
        $this->seeInDatabase(
            'rankings',
            [
                'id' => $ranking->id,
                'score' => $ranking->score,
            ]
        );
    }

    /**
     * Tests if the update rankings throws 
     * a ModelNotFoundException when
     * appropriated.
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testRepoUpdateRankingsUpdateFailure()
    {
        $admin = Factory::create('App\\Models\\Administrator');
        $ranking = $this->repo->updateRanking(
            $admin,
            1222,
            123,
            Factory::create('App\\Models\\Tournament'),
            Factory::create('App\\Models\\Player')
        );
    }

    /**
     * Tests if the remove rankings works
     * correclty.
     */
    public function testRepoRemoveRankingRemovalSuccess()
    {
        $ranking = Factory::create('App\\Models\\Ranking');
        $admin = Administrator::find(
            Tournament::find($ranking->tournament_id)->created_by
        );
        $result = $this->repo->removeRanking(
            $admin,
            $ranking->id
        );
        $this->assertTrue(
            $result
        );
        $this->assertNull(
            Ranking::find($ranking->id)
        );
    }

    /**
     * Tests if the remove rankings throws
     * a ModelNotFoundException when an
     * invalid rank id is passed.
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testRepoRemoveRankingRemovalFailure()
    {
        $this->repo->removeRanking(
            Factory::create('App\\Models\\Administrator'),
            '1233'
        );
    }
}

