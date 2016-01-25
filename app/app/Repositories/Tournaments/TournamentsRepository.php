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
    ) {
        $tournament = new Tournament();
        $tournament->created_by = $admin->id;
        $tournament->name = $name;
        $tournament->begin = $begin;
        $tournament->finish = $finish;
        $tournament->has_ended = $has_ended;
        $tournament->save();

        return $tournament;
    }

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
    ) {
        $tournament = Tournament::where('name', $name)
            ->where('created_by', $admin->id)
            ->firstOrFail();

        if ($newName)
            $tournament->name = $newName;
        if ($begin)
            $tournament->begin = $begin;
        if ($finish)
            $tournament->finish = $finish;
        $tournament->has_ended = $has_ended;

        $tournament->save();

        return $tournament;
    }

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
    ) {
        return Tournament::where('name', $name)
            ->where('created_by', $admin->id)
            ->firstOrFail()
            ->delete();
    }
}

