<?php

namespace App\Repositories\Players;

use App\Models\User;
use App\Models\Player;

/**
 * Implementation for the IPlayers repo.
 */
class PlayersRepository implements IPlayerRepository
{
    /**
     * Adds a player into the DB.
     *
     * @param User $user
     * @param str $nickname
     *
     * @return Player
     */
    public function addPlayer(
        User $user,
        $nickname
    ) {
        return null;
    }
}

