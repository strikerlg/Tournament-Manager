<?php

namespace Tests\Administrators\Integration;

use Laracasts\TestDummy\Factory;

/**
 * Test for the admin repo.
 */
class AdministratorsRepoIntegrationTest extends \TestCase
{
    /**
     * @var IAdministratorsRepository
     */
    private $repo;

    /**
     * Setup method.
     */
    public function setup()
    {
        parent::setup();
        $this->repo = $this->app->make(
            'App\\Repositories\\Administrators\\IAdministratorsRepository'
        );
    }

    /**
     * Teardown method.
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
     * Tests if the repo addAdministrator adds an
     * admin properly.
     */
    public function testRepoAddAdminSuccessAddition()
    {
        $user = Factory::create('App\\Models\\User');
        $admin = $this->repo->addAdministrator(
            $user,
            'testing nickname'
        );
        $this->assertNotNull(
            $admin
        );
        $this->assertInstanceOf(
            'App\\Models\\Administrator',
            $admin
        );
        $this->seeInDatabase(
            'administrators',
            [
                'id' => $admin->id,
                'nickname' => $admin->nickname,
                'user_id' => $admin->user_id,
            ]
        );
    }

    /**
     * Tests if the repo removeAdministrator removes an
     * admin properly.
     */
    public function testRepoRemoveAdminSuccessRemoval()
    {
        $admin = Factory::create('App\\Models\\Administrator');
        $wasDeleted = $this->repo->removeAdministrator(
            $admin->nickname
        );
        $this->assertTrue($wasDeleted);
        $this->assertNull(
            Administrator::find($admin->id)
        );
    }

    /**
     * Tests if the repo remove admin throws a modelNotFound
     * Excpetion correclty.
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testRepoRemoveAdminFailureNotFound()
    {
        $this->repo->removeAdministrator(
            'testing not found'
        );
    }
}

