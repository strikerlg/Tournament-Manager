<?php

namespace App\Repositories\Matches;

use App\Repositories\IRepository;
use App\Models\Administrator;
use App\Models\Tournament;
use App\Models\Player;
use App\Models\Match;

/**
 * Implementation for the Matches repo.
 */
class MatchesRepository implements
    IMatchesRepository,
    IRepository
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
        $match = new Match();
        $match->created_by = $admin->id;
        $match->tournament_id = $tournament->id;
        $match->first_player_id = $firstPlayer->id;
        $match->second_player_id = $secondPlayer->id;
        $match->begin = $begin;
        $match->finish = $finish;
        $match->save();

        return $match;
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
        $match = Match::where('id', $matchID)
            ->where('created_by', $admin->id)
            ->firstOrFail();
        
        if ($newFirstPlayer) {
            $match->first_player_id = $newFirstPlayer->id;
        }

        if ($newSecondPlayer) {
            $match->second_player_id = $newSecondPlayer->id;
        }

        if ($winner) {
            $match->winner = $winner->id;
        }

        if ($newBegin) {
            $match->begin = $newBegin;
        }

        if ($newFinish) {
            $match->finish = $newFinish;
        }

        if ($hasEnded) {
            $match->has_ended = $hasEnded;
        }

        $match->save();

        return $match;
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
        return Match::where('id', $matchID)
            ->where('created_by', $admin->id)
            ->firstOrFail()
            ->delete();
    }
}

