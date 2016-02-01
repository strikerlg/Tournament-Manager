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
}
