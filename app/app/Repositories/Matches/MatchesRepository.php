<?php

namespace App\Repositories\Matches;

use App\Models\Administrator;
use App\Models\Tournament;
use App\Models\Player;

/**
 * Implementation for the Matches repo.
 */
class MatchesRepository implements IMatchesRepository
{
    /**
     * Adds a new match into the DB.
     *
     * @param Administrator $admin
     * @param Tournament $tournament
     * @param Player $firstPlayer
     * @param Player $secondPlayer
     * @param Carbon\Carbon $begin
     * @param Carbon\Carbon $finish
     *
     * @return Match
     */
    public function addMatch(
        Administrator $admin,
        Tournament $tournament,
        Player $firstPlayer,
        Player $secondPlayer,
        \Carbon\Carbon $begin,
        \Carbon\Carbon $finish
    ) {
        return null;
    }

    /**
     * Updates a match back into the DB.
     *
     * @param Administrator $admin
     * @param int $matchID
     * @param Player $newFirstPlayer
     * @param Player $newSecondPlayer
     * @param Player $winner
     * @param Carbon\Carbon $newBegin
     * @param Carbon\Carbon $newFinish
     * @param boolean $hasEnded
     *
     * @throws ModelNotFoundException
     *
     * @return Match
     */
    public function updateMatch(
        Administrator $admin,
        $matchID,
        Player $newFirstPlayer = null,
        Player $newSecondPlayer = null,
        Player $winner = null,
        \Carbon\Carbon $newBegin = null,
        \Carbon\Carbon $newFinish = null,
        $hasEnded = false
    ) {
        return null;
    }

    /**
     * Removes a match from the DB.
     *
     * @param Administrator $admin
     * @param int $matchID
     *
     * @throws ModelNotFoundException
     *
     * @return boolean
     */
    public function removeMatch(
        Administrator $admin,
        $matchID
    ) {
        return false;
    }
}

