<?php

namespace Tests\Players\Integration;

class PlayersRoutesIntegrationTest extends \TestCase
{
    /**
     * Test is working.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests if a player can register
     * correctly.
     */
    public function testRegisterPlayerPlayerRegistered()
    {
        $playerData = [
            'name' => 'player',
            'email' => 'player@player.test',
            'password' => '123456',
            'password_confirm' => '123456',
        ];

        $response = $this->assertOk(
            'POST',
            '/register/player',
            $playerData
        );

        $this->assertNotNull($response->player);
        $this->seeInDatabase('players', [
            'nickname' => 'player',
        ]);
    }

}

