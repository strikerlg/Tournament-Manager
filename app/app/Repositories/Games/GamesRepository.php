<?php

namespace App\Repositories\Games;

use App\Repositories\IRepository;
use App\Models\Game;

/**
 * Implementation for the Games repo.
 */
class GamesRepository implements
    IGamesRepository,
    IRepository
{
    /**
     * Gets the desired model.
     *
     * @param $id
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return Model
     */
    public function get($id)
    {
        return Game::findOrFail($id);
    }

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
        $game = new Game();
        $game->name = $name;
        $game->save(); 

        return $game;
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
        return Game::where('name', $name)
            ->firstOrFail()
            ->delete();
    }

}

