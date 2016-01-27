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

    /**
     * Tests if the add rankings works 
     * correclty.
     */
    public function testRepoAddRankingsAdditionSuccess()
    {
        $this->markTestIncomplete('write me');
    }

    /**
     * Tests if the update rankings works 
     * correclty.
     */
    public function testRepoUpdateRankingsUpdateSuccess()
    {
        $this->markTestIncomplete('write me');
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
        $this->markTestIncomplete('write me');
    }

    /**
     * Tests if the remove rankings works
     * correclty.
     */
    public function testRepoRemoveRankingRemovalSuccess()
    {
        $this->markTestIncomplete('write me');
    }

    /**
     * Tests if the remove rankings throws
     * a ModelNotFoundException when an
     * invalid rank id is passed.
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testRepoRemoveRankingRemovalSuccess()
    {
        $this->markTestIncomplete('write me');
    }
}

