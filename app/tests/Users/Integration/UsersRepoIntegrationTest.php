<?php

namespace Tests\Users\Integration;

/**
 * Class for testing the users repo.
 */
class UsersRepoIntegrationTest extends \TestCase
{

    /**
     * @var IUsersRepository
     */
    private $repo = null;

    /**
     * Setup method
     */
    public function setup()
    {
        parent::setup();

        $this->repo = $this->app->make(
            'App\Repositories\Users\IUsersRepository'
        );
    }

    /**
     * Teardown method
     */
    public function teardown()
    {
        $this->repo = null;
    }

    /**
     * Basic is working assertion.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests the User addition function within the repository.
     */
    public function testAddUserSuccess()
    {
        $user = $this->repo->addUser(
            'user@mail.com',
            'user name',
            'pass'
        );
        $this->assertNotNull($user);
        $this->assertInstanceOf('App\Models\User', $user);
        $this->seeInDatabase('users', ['user@mail.com']);
    }

}

