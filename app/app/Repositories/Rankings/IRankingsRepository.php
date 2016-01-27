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
     * @param Player $player
     * @param Tournament $tournament
     * @param int $score
     *
     * @return Ranking
     */
    public function addRanking(
        Player $player,
        Tournament $tournament,
        $score = 0
    );

    /**
     * Updates the existing ranking
     * passed.
     *
     * @param int $rankingID
     * @param int $score
     * @param Tournament $tournament
     * @param Player $player
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return Ranking
     */
    public function updateRanking(
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
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return boolean
     */
    public function removeRanking(
        Administrator $admin,
        $rankingID
    );
}
