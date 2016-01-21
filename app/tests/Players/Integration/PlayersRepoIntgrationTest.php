<?php

namespace Tests\Players\Integration;

/**
 * Class used to test the Players repo tests.
 */
class PlayersRepoIntegrationTest extends \TestCase
{

    /**
     * Basic is working test.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests if the add player of the repo is working.
     */
    public function testRepoAddPlayerSuccessAddition()
    {
        $player = $this->repo->addPlayer(
            'nickname'
        );
        $this->assertNotNull($player);
        $this->assertInstanceOf(
            'App\Models\Player',
            $player
        );
        $this->seeInDatabase(
            'players',
            [
                'id' => $player->id,
                'nickname' => $player->nickname,
                'user_id' => $player->user_id,
            ]
        );
    }

    /**  
     * Tests if the remove function works correctly.
     */
    public function testRepoRemovePlayerSuccessRemoval()
    {
        $player = Player::add();  // this should be added using a helper factory.
        $this->repo->removePlayer(
            'player_nickname'
        );
        $this->assertNull(
            Player::find($player->id)
        );
    }
}

