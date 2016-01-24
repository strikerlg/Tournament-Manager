<?php

namespace App\Repositories\Tournaments;

use App\Models\Administrator;
use App\Models\Tournament;

/**
 * Interface for the Tournament repo.
 */
class TournamentsRepository implements ITournamentsRepository
{
    /**
     * Adds a new Tournament into the DB.
     *
     * @param str $name
     * @param Carbon $begin
     * @param Carbon $finish
     * @param bool $has_ended
     *
     * @return Tournament
     */
    public function addTournament(
        $name,
        $begin,
        $finish,
        $has_ended = false
    ) {
        return null;
    }

    /**
     * Updates an existing Tournament.
     *
     * @param str $name
     * @param Carbon $begin
     * @param Carbon $finish
     * @param bool $has_ended
     * @param str $newName
     * 
     * @return Tournament
     */
    public function updateTournament(
        $name,
        $begin = null,
        $finish = null,
        $has_ended = false,
        $newName = null
    ) {
        return null;
    }

    /**
     * Removes an existing Tournament.
     *
     * @param str $name
     *
     * @return boolean
     */
    public function deleteTournament(
        $name
    ) {
        return false;
    }
}

