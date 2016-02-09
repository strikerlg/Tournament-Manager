<?php

namespace App\Repositories\Players;

use App\Repositories\IRepository;
use App\Models\User;
use App\Models\Player;

/**
 * Implementation for the IPlayers repo.
 */
class PlayersRepository implements
    IPlayersRepository,
    IRepository
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
        $player = new Player();
        $player->user_id = $user->id;
        $player->nickname = $nickname;
        $player->save();

        return $player;
    }

    /**
     * Removes the specified player.
     *
     * @param str $nickname
     *
     * @throws ModelNotFoundException
     *
     * @return bool
     */
    public function removePlayer(
        $nickname
    ) {
        return Player::where('nickname', $nickname)
            ->firstOrFail()->delete();
    }
}

