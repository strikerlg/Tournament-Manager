<?php

namespace App\Repositories\Games;

use App\Models\Game;

/**
 * Implementation for the Games repo.
 */
class GamesRepository
{
    /**
     * Adds a Game to the DB.
     *
     * @param str $name
     *
     * @return Game
     */
    public function addGame(
        $name
    ) {
        return null;
    }

    /**
     * Removes the specified Game.
     *
     * @param str $name
     *
     * @throws ModelNotFoundException
     *
     * @return bool
     */
    public function removeGame(
        $name
    ) {
        return false;
    }

}

