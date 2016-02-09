<?php

namespace App\Repositories\Rankings;

use App\Models\Administrator;
use App\Models\Tournament;
use App\Models\Player;

/**
 * Interface for the rankings repo.
 */
interface IRankingsRepository
{
    /**
     * Adds a new ranking for the passed
     * player in the passed tournament.
     *
     * @param Administrator $admin
     * @param Player $player
     * @param Tournament $tournament
     * @param int $score
     *
     * @throws Illuminate\Validation\ValidationException
     *
     * @return Ranking
     */
    public function addRanking(
        Administrator $admin,
        Player $player,
        Tournament $tournament,
        $score = 0
    );

    /**
     * Updates the existing ranking
     * passed.
     *
     * @param Administrator $admin
     * @param int $rankingID
     * @param int $score
     * @param Tournament $tournament
     * @param Player $player
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws Illuminate\Validation\ValidationException
     *
     * @return Ranking
     */
    public function updateRanking(
        Administrator $admin,
        $rankingID,
        $score = null,
        Tournament $tournament = null,
        Player $player = null
    );

    /**
     * Removes an existing ranking.
     *
     * @param Administrator $admin
     * @param int $matchID
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws Illuminate\Validation\ValidationException
     *
     * @return boolean
     */
    public function removeRanking(
        Administrator $admin,
        $rankingID
    );
}

