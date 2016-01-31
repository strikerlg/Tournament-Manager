<?php

namespace App\Services\Tournaments;

use App\Repositories\Tournaments\ITournamentsRepository;

class TournamentsService
{
    /**
     * @var ITournamentsRepository
     */
    protected $repo;

    /**
     * Constructor.
     */
    public function __construct(
        ITournamentsRepository $tournamentsRepo
    ) {
        $this->repo = $tournamentsRepo;
    }

    /**
     * Adds a new tournament.
     *
     * @param string $name
     * @param Carbon $begin
     * @param Carbon $finish
     * @param boolean $hasFinished
     *
     * @return Tournament
     */
    public function addTournament(
        $name,
        \Carbon\Carbon $begin,
        \Carbon\Carbon $finish,
        $hasFinished = false
    ) {
        return $this->repo->addTournament(
            \Admin::getLogged(),
            $name,
            $begin,
            $finish,
            $hasFinished
        );
    }

    /**
     * Removes a tournament.
     *
     * @param string $name
     *
     * @return boolean
     */
    public function removeTournament(
        $name
    ) {
        return $this->repo->removeTournament(
            \Admin::getLogged(),
            $name
        );
    }
}

