<?php

namespace App\Services\Rankings;

use App\Repositories\Rankings\IRankingsRepository;
use App\Repositories\Players\IPlayersRepository;
use App\Repositories\Tournaments\ITournamentsRepository;
use App\Repositories\Administrators\IAdministratorsRepository;

class RankingsService
{
    /**
     * @var IRankingsRepository
     */
    protected $repo;

    /**
     * @var IPlayersRepository
     */
    protected $playersRepo;

    /**
     * @var ITournamentsRepository
     */
    protected $tournamentsRepo;

    /**
     * @var IAdministratorsRepository
     */
    protected $administratorsRepository;

    /**
     * Constructor.
     */
    public function __construct(
        IRankingsRepository $repo,
        IPlayersRepository $playersRepo,
        ITournamentsRepository $tournamentsRepo,
        IAdministratorsRepository $administratorsRepository
    ) {
        $this->repo = $repo;
        $this->playersRepo = $playersRepo;
        $this->tournamentsRepo = $tournamentsRepo;
        $this->administratorsRepository = $administratorsRepository;
    }

    /**
     * Adds a new Ranking into
     * the provided tournament.
     *
     * @param int $adminID
     * @param int $playerID
     * @param int $tournamentID
     * @param int $score
     *
     * @return Ranking
     */
    public function addRanking(
        $adminID,
        $playerID,
        $tournamentID,
        $score
    ) {
        $admin = $this->administratorsRepository->get(
            $adminID
        );
        $player = $this->playersRepo->getPlayer(
            $playerID
        );
        $tournament = $this->tournamentsRepo->getTournament(
            $tournamentID
        );
        return $this->repo->addRanking(
            $admin,
            $player,
            $tournament,
            $score
        );
    }

    /**
     * Updates a Ranking into
     * the provided tournament.
     *
     * @param int $adminID
     * @param int $rankingID
     * @param int $score
     * @param int $tournamentID
     * @param int $playerID
     *
     * @return Ranking
     */
    public function updateRanking(
        $adminID,
        $rankingID,
        $score = 0,
        $tournamentID = null,
        $playerID = null
    ) {
        $admin = $this->administratorsRepository->get($adminID);
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
            $admin,
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

