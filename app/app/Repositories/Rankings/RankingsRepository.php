<?php

namespace App\Repositories\Rankings;

use App\Repositories\IRepository;
use App\Models\Administrator;
use App\Models\Tournament;
use App\Models\Player;
use App\Models\Ranking;

use Illuminate\Validation\ValidationException;

/**
 * Implementation for the rankings repo.
 */
class RankingsRepository implements
    IRankingsRepository,
    IRepository
{
    /**
     * Gets the desired model.
     *
     * @param $id
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return Model
     */
    public function get($id)
    {
        return Ranking::findOrFail($id);
    }

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
        $this->validatePlayer($tournament, $player);
        // TODO: Check and return if ranking already exists.

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
     * @param Player $player
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return Ranking
     */
    public function updateRanking(
        Administrator $admin,
        $rankingID,
        $score
    ) {
        $ranking = $this->retrieveRanking(
            $admin,
            $rankingID
        );
        $ranking->score = $score;
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
        $ranking = $this->retrieveRanking(
            $admin,
            $rankingID
        );
        return $ranking->delete();
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

    /**
     * Validates the Player and the
     * Tournament relashionships
     *
     * @param Tournament $tournament
     * @param Player $player
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     */
    private function validatePlayer(
        Tournament $tournament,
        Player $player
    ) {
        $tournament
            ->players()
            ->where('player_id', $player->id)
            ->firstOrFail();
    }

    /**
     * Retrieves the desired Ranking.
     *
     * @param Administrator $admin
     * @param int $rankingID
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return Ranking
     */
    private function retrieveRanking(
        Administrator $admin,
        $rankingID
    ) {
        return Ranking::where('rankings.id', $rankingID)
            ->join(
                'tournaments',
                'rankings.tournament_id',
                '=',
                'tournaments.id'
            )
            ->where('tournaments.created_by', $admin->id)
            ->firstOrFail();
    }

}

