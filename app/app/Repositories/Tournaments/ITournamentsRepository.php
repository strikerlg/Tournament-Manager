<?php

namespace App\Repositories\Tournaments;

use App\Models\Administrator;
use App\Models\Tournament;

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
     * @param Carbon $begin
     * @param Carbon $finish
     * @param bool $has_ended
     *
     * @return Tournament
     */
    public function addTournament(
        Administrator $admin,
        $name,
        $begin, 
        $finish,
        $has_ended = false
    );

    /**
     * Updates an existing Tournament.
     *
     * @param Administrator $admin
     * @param str $name
     * @param Carbon $begin
     * @param Carbon $finish
     * @param bool $has_ended
     * @param str $newName
     * 
     * @return Tournament
     */
    public function updateTournament(
        Administrator $admin,
        $name,
        $begin = null,
        $finish = null,
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
}

