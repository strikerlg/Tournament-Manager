<?php

namespace App\Repositories\Players;

use App\Models\User;
use App\Models\Player;

/**
 * Interface for the players repo.
 */
interface IPlayersRepository
{
    /**
     * Adds a player to the DB.
     *
     * @param User $user
     * @param str $nickname
     *
     * @return Player
     */
    public function addPlayer(
        User $user,
        $nickname
    );
}

