<?php

namespace App\Services\Players;

use App\Repositories\Users\IUsersRepository;
use App\Repositories\Players\IPlayersRepository;

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
     * Constructor.
     *
     * @param IUsersRepository $usersRepo
     * @param IPlayersRepository $playersRepo
     *
     * @return PlayersService
     */
    public function __construct(
        IUsersRepository $usersRepo,
        IPlayersRepository $playersRepo
    ) {
        $this->usersRepo = $usersRepo;
        $this->playersRepo = $playersRepo;
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
        return null;
    }
}

