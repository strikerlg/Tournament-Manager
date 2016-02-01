<?php

namespace App\Services\Matches;

use App\Repositories\Matches\IMatchesRepository;
use App\Repositories\Tournaments\ITournamentsRepository;
use App\Repositories\Players\IPlayersRepository;

class MatchesService
{
    /**
     * @var IMatchesRepository
     */
    protected $repo;

    /**
     * @var ITournamentRepository
     */
    protected $tournamentsRepo;

    /**
     * @var IPlayersRepository
     */
    protected $playersRepo;

    /**
     * Constructor.
     */
    public function __construct(
        IMatchesRepository $repo,
        ITournamentsRepository $tournamentsRepo,
        IPlayersRepository $playersRepo
    ) {
        $this->repo = $repo;
        $this->tournamentsRepo = $tournamentsRepo;
        $this->playersRepo = $playersRepo;
    }

    /**
     * Adds a new match into the desired
     * Organization.
     *
     * @param int $tournamentID
     * @param int $firstPlayerID
     * @param int $secondPlayerID
     * @param Carbon $begin
     * @param Carbon $finish
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return Match
     */
    public function addMatch(
        $tournamentID,
        $firstPlayerID,
        $secondPlayerID,
        \Carbon\Carbon $begin,
        \Carbon\Carbon $finish
    ) {
        $tournament = $this->tournamentsRepo->getTournament(
            $tournamentID
        );
        $firstPlayer = $this->playersRepo->getPlayer(
            $tournament,
            $firstPlayerID
        );
        $secondPlayer = $this->playersRepo->getPlayer(
            $tournament,
            $secondPlayerID
        );
        return $this->repo->addMatch(
            \Admin::getLogged(),
            $tournament,
            $firstPlayer,
            $secondPlayer,
            $begin,
            $finish
        );
    }

    /**
     * Updates an existing match into the desired
     * Organization.
     *
     * @param int $matchID
     * @param int $firstPlayerID
     * @param int $secondPlayerID
     * @param int $winnerID
     * @param Carbon $begin
     * @param Carbon $finish
     * @param boolean $hasEnded
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return Match
     */
    public function updateMatch(
        $matchID,
        $firstPlayerID = null,
        $secondPlayerID = null,
        $winnerID = null,
        \Carbon\Carbon $begin = null,
        \Carbon\Carbon $finish = null,
        $hasEnded = false
    ) {
        $firstPlayer = null;
        $secondPlayer = null;
        $winner = null;

        if ($firstPlayerID) {
            $firstPlayer = $this->playersRepo->getPlayer(
                $firstPlayerID
            );
        }
        if ($secondPlayerID) {
            $secondPlayer = $this->playersRepo->getPlayer(
                $secondPlayerID
            );
        }
        if ($winnerID) {
            $winner = $this->playersRepo->getPlayer(
                $winnerID
            );
        }
        return $this->repo->updateMatch(
            \Admin::getLogged(),
            $matchID,
            $firstPlayer,
            $secondPlayer,
            $winner,
            $begin,
            $finish,
            $hasEnded
        );
    }
}

