<?php

namespace App\Services\Rankings;

use App\Repositories\Rankings\IRankingsRepository;
use App\Repositories\Players\IPlayersRepository;
use App\Repositories\Tournaments\ITournamentsRepository;

class RankingsService
{
    /**
     * @var IRankingsRepository
     */
    protected $repo;

    /**
     * @var IRankingsRepository
     */
    protected $playersRepo;

    /**
     * @var IRankingsRepository
     */
    protected $tournamentsRepo;

    /**
     * Constructor.
     */
    public function __construct(
        IRankingsRepository $repo,
        IPlayersRepository $playersRepo,
        ITournamentsRepository $tournamentsRepo
    ) {
        $this->repo = $repo;
        $this->playersRepo = $playersRepo;
        $this->tournamentsRepo = $tournamentsRepo;
    }

    /**
     * Adds a new Ranking into
     * the provided tournament.
     *
     * @param int $playerID
     * @param int $tournamentID
     * @param int $score
     *
     * @return Ranking
     */
    public function addRanking(
        $playerID,
        $tournamentID,
        $score
    ) {
        // TODO: Get Admin.
        $player = $this->playersRepo->getPlayer(
            $playerID
        );
        $tournament = $this->tournamentsRepo->getTournament(
            $tournamentID
        );
        return $this->repo->addRanking(
            $player,
            $tournament,
            $score
        );
    }

    /**
     * Updates a Ranking into
     * the provided tournament.
     *
     * @param int $rankingID
     * @param int $score
     * @param int $tournamentID
     * @param int $playerID
     *
     * @return Ranking
     */
    public function updateRanking(
        $rankingID,
        $score = 0,
        $tournamentID = null,
        $playerID = null
    ) {
        $player = null;
        $tournament = null;

        if ($playerID) {
            $player = $this->playersRepo->getPlayer(
                $playerID
            );
        }
        if ($tournamentID) {
            $tournament = $this->tournamentsRepo->getTournament(
                $tournamentID
            );
        }

        return $this->repo->updateRanking(
            $rankingID,
            $score,
            $tournament,
            $player
        );
    }

    /**
     * Removes the specified ranking.
     *
     * @param $rankingID
     *
     * @return boolean
     */
    public function removeRanking(
        $rankingID
    ) {
        return $this->repo->removeRanking(
            \Admin::getLogged(),
            $rankingID
        );
    }
}

