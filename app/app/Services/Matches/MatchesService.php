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
}

