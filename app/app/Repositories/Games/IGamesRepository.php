<?php

namespace App\Repositories\Games;

use App\Models\Game;

/**
 * Interface for the Games repo.
 */
interface IGamesRepository
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
    );

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
    );
}

