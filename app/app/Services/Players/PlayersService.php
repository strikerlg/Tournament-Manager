<?php

namespace App\Services\Players;

use App\Repositories\Users\IUsersRepository;
use App\Repositories\Players\IPlayersRepository;
use App\Repositories\Tournaments\ITournamentsRepository;

/**
 * Players Service implementation.
 */
class PlayersService
{
    /**
     * @var IPlayersRepository
     */
    protected $playersRepo;

    /**
     * @var IUsersRepository
     */
    protected $usersRepo;

    /**
     * @var ITournamentsRepository
     */
    protected $tournamentsRepo;

    /**
     * Constructor.
     *
     * @param IUsersRepository $usersRepo
     * @param IPlayersRepository $playersRepo
     * @param ITournamentsRepository $tournamentsRepo
     *
     * @return PlayersService
     */
    public function __construct(
        IUsersRepository $usersRepo,
        IPlayersRepository $playersRepo,
        ITournamentsRepository $tournamentsRepo
    ) {
        $this->usersRepo = $usersRepo;
        $this->playersRepo = $playersRepo;
        $this->tournamentsRepo = $tournamentsRepo;
    }

    /**
     * Calls the repo add player method,
     * Passing the retrieved User.
     *
     * @param int $userID
     * @param string $nickname
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return Player
     */
    public function addPlayer(
        $userID,
        $nickname
    ) {
        $user = $this->usersRepo->getUser($userID);
        return $this->playersRepo->addPlayer(
            $user,
            $nickname
        );
    }

    /**
     * Gets the players count of a
     * given tournament.
     *
     * @param int $tournamentID
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return int
     */
    public function getPlayersCount(
        $tournamentID
    ) {
        $tournament = $this->tournamentsRepo->getTournament(
            $tournamentID
        );
        return $this->playersRepo->getCount(
            $tournament
        );
    }

    /**
     * Deletes all the players of a
     * given tournament.
     *
     * @param int $tournamentID
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return boolean
     */
    public function deletePlayers(
        $tournamentID
    ) {
        $tournament = $this->tournamentsRepo->getTournament(
            $tournamentID
        );
        // TODO: Get the logged Administrator
        return $this->playersRepo->deletePlayers(
            $tournament
        );
    }

    /**
     * Deletes the specified player
     * from the given tournament.
     *
     * @param int $tournamentID
     * @param int $playerID
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return boolean
     */
    public function deletePlayer(
        $tournamentID,
        $playerID
    ) {
        $tournament = $this->tournamentsRepo->getTournament(
            $tournamentID
        );
        return $this->playersRepo->deletePlayer(
            $tournament,
            $playerID
        );
    }
}

