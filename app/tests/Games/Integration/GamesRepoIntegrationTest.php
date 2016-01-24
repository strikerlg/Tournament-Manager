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
    private $repo;

    /**
     * Setup method
     */
    public function setup()
    {
        parent::setup();
        $this->repo = $this->app->make(
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
}

