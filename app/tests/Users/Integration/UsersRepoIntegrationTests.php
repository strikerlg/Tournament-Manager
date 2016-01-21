<?php

namespace Tests\Users\Integration;

/**
 * Class for testing the users repo.
 */
class UsersRepoIntegrationTest extends TestCase
{
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
            'pass'
        );
        $this->assertNotNull($user);
        $this->assertInstanceOf($user, 'App\Models\User');
        $this->seeInDatabase('users', ['user@mail.com']);
    }

}

