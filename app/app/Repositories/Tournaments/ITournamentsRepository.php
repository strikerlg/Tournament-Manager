<?php

namespace App\Repositories\Tournaments;

use App\Models\Administrator;
use App\Models\Tournament;
use App\Models\Player;

/**
 * Interface for the Tournament repo.
 */
interface ITournamentsRepository
{
    /**
     * Adds a new Tournament into the DB.
     *
     * @param Administrator $admin
     * @param str $name
     * @param Carbon\Carbon $begin
     * @param Carbon\Carbon $finish
     * @param bool $has_ended
     *
     * @return Tournament
     */
    public function addTournament(
        Administrator $admin,
        $name,
        \Carbon\Carbon $begin, 
        \Carbon\Carbon $finish,
        $has_ended = false
    );

    /**
     * Updates an existing Tournament.
     *
     * @param Administrator $admin
     * @param str $name
     * @param Carbon\Carbon $begin
     * @param Carbon\Carbon $finish
     * @param bool $has_ended
     * @param str $newName
     * 
     * @return Tournament
     */
    public function updateTournament(
        Administrator $admin,
        $name,
        \Carbon\Carbon $begin = null,
        \Carbon\Carbon $finish = null,
        $has_ended = false,
        $newName = null
    );

    /**
     * Removes an existing Tournament.
     *
     * @param Administrator $admin
     * @param str $name
     *
     * @return boolean
     */
    public function removeTournament(
        Administrator $admin,
        $name
    );

    /**
     * Attaches a new player into the
     * tournament.
     *
     * @param $admin
     * @param $name
     * @param Player
     *
     * @return boolean
     */
    public function attachPlayer(
        Administrator $admin,
        $name,
        Player $player
    );

}

