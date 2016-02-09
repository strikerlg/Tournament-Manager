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
    private $repository = null;

    /**
     * Setup method
     */
    public function setup()
    {
        parent::setup();

        $this->repository = $this->app->make(
            'App\Repositories\Users\IUsersRepository'
        );
    }

    /**
     * Teardown method
     */
    public function teardown()
    {
        $this->repository = null;
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
        $user = $this->repository->addUser(
            'user@mail.com',
            'user name',
            'pass'
        );
        $this->assertNotNull($user);
        $this->assertInstanceOf('App\Models\User', $user);
        $this->seeInDatabase('users', ['email' => 'user@mail.com']);
    }

}

