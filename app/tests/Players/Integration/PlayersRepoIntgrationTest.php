<?php

namespace Tests\Players\Integration;

use App\Models\Player;
use Laracasts\TestDummy\Factory;

/**
 * Class used to test the Players repo tests.
 */
class PlayersRepoIntegrationTest extends \TestCase
{

    /**
     * @var IPlayerRepository
     */
    private $repository;

    /**
     * Setup method
     */
    public function setup()
    {
        parent::setup();
        $this->repository = $this->app->make(
            'App\\Repositories\\Players\\IPlayersRepository'
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
     * Basic is working test.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests if the add player of the repo is working.
     */
    public function testRepoAddPlayerSuccessAddition()
    {
        $user = Factory::create('App\\Models\\User');
        $player = $this->repository->addPlayer(
            $user,
            'nickname'
        );
        $this->assertNotNull($player);
        $this->assertInstanceOf(
            'App\Models\Player',
            $player
        );
        $this->seeInDatabase(
            'players',
            [
                'id' => $player->id,
                'nickname' => $player->nickname,
                'user_id' => $player->user_id,
            ]
        );
    }

    /**
     * Tests if the remove function works correctly.
     */
    public function testRepoRemovePlayerSuccessRemoval()
    {
        $player = Factory::create('App\\Models\\Player');
        $success = $this->repository->removePlayer(
            $player->nickname
        );
        $this->assertTrue(
            $success
        );
        $this->assertNull(
            Player::find($player->id)
        );
    }

    /**
     * Tests if a ModelNotFoundException is thrown.
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testRepoRemovePlayerFailureNotFound()
    {
        $this->repository->removePlayer('test');
    }
}

