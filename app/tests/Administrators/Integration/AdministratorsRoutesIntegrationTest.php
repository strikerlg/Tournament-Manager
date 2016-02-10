<?php

namespace Tests\Administrators\Integration;

/**
 * Tests the routes for creating a new
 * admin.
 */
class AdministratorsRoutesIntegrationTest extends \TestCase
{
    /**
     * Basic is working test.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Test admin addition through
     * admin registration route.
     */
    public function testRegisterAdminAdminRegistered()
    {
        $adminData = [
            'name' => 'owner',
            'email' => 'owner@email.test',
            'password' => '123456',
            'password_confirm' => '123456',
        ];

        $response = $this->assertRequest(
            '/administrator/register',
            'POST',
            $adminData
        );

        $this->assertNotNull($response->administrator);

        $this->seeInDatabase('administrators', [
            'name' => 'owner'
        ]);
    }

}

