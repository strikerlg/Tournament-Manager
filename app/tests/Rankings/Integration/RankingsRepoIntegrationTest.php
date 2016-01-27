<?php

namespace Tests\Rankings\Integration;

use App\Models\Player;
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
}

