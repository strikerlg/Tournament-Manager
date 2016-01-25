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
}

