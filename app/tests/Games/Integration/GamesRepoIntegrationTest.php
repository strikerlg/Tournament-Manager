<?php

namespace Tests\Games\Integration;

use App\Models\Game;
use Laracasts\TestDummy\Factory;

/**
 * Class used to test the Games repo tests.
 */
class GamesRepoIntegrationTest extends \TestCase
{
    /**
     * @var IGamesRepository
     */
    private $repository;

    /**
     * Setup method
     */
    public function setup()
    {
        parent::setup();
        $this->repository = $this->app->make(
            'App\\Repositories\\Games\\IGamesRepository'
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
     * Test is working.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests if the add method on the repo
     * works correclty.
     */
    public function testRepoAddGameAdditionSuccess()
    {
        $game = $this->repository->addGame(
            'testing name'
        );
        $this->assertNotNull($game);
        $this->assertInstanceOf(
            'App\\Models\\Game',
            $game
        );
        $this->seeInDatabase('games', [
            'id' => $game->id,
            'name' => $game->name
        ]);
    }

    /**
     * Tests if the remove method
     * is working correclty.
     */
    public function testRepoRemoveGameRemovalSuccess()
    {
        $game = Factory::create('App\\Models\\Game');
        $this->repository->removeGame($game->name);
        $this->assertNull(Game::find($game->id));
    }

    /**
     * Tests if the remove throws a modelNotFound
     * Exception when passing an inexistent
     * game id.
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testRepoRemoveGameNotFound()
    {
        $this->repository->removeGame('test failure');
    }
}

