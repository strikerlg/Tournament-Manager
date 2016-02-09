<?php

namespace App\Repositories\Rankings;

use App\Models\Administrator;
use App\Models\Tournament;
use App\Models\Player;
use App\Models\Ranking;

use Illuminate\Validation\ValidationException;

/**
 * Implementation for the rankings repo.
 */
class RankingsRepository implements IRankingsRepository
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
     * @return Ranking
     */
    public function addRanking(
        Administrator $admin,
        Player $player,
        Tournament $tournament,
        $score = 0
    ) {
        $this->validateOwnership($admin, $tournament);

        $ranking = new Ranking;
        $ranking->player_id = $player->id;
        $ranking->tournament_id = $tournament->id;
        $ranking->score = $score;
        $ranking->save();

        return $ranking;
    }

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
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return Ranking
     */
    public function updateRanking(
        Administrator $admin,
        $rankingID,
        $score = null,
        Tournament $tournament = null,
        Player $player = null
    ) {
        $ranking = Ranking::findOrFail($rankingID);
        if ($score) {
            $ranking->score = $score;
        }
        if ($tournament) {
            $ranking->tournament_id = $tournament->id;
        }
        if ($player) {
            $ranking->player_id = $player->id;
        }
        $ranking->save();

        return $ranking;
    }

    /**
     * Removes an existing ranking.
     *
     * @param Administrator $admin
     * @param int $rankingID
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return boolean
     */
    public function removeRanking(
        Administrator $admin,
        $rankingID
    ) {
        return Ranking::findOrFail($rankingID)
            ->delete();
    }

    /**
     * Validates the admin and the
     * tournament relationships.
     *
     * @param Administrator $admin
     * @param Tournament $tournament
     *
     * @throws Illuminate\Validation\ValidationException
     */
    private function validateOwnership(
        Administrator $admin,
        Tournament $tournament
    ) {
        if ($admin->id != $tournament->created_by) {
            throw new ValidationException(
                'The passed admin is not associated with the tournament'
            );
        }
    }

}

