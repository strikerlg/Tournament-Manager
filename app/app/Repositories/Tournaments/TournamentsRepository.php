<?php

namespace App\Repositories\Tournaments;

use App\Repositories\IRepository;
use App\Models\Administrator;
use App\Models\Tournament;
use App\Models\Player;

/**
 * Interface for the Tournament repo.
 */
class TournamentsRepository implements
    ITournamentsRepository,
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
        return Tournament::findOrFail($id);
    }

    /**
     * Adds a new Tournament into the DB.
     *
     * @param Administrator $admin
     * @param str $name
     * @param Carbon\Carbon $begin
     * @param Carbon\Carbon $finish
     * @param bool $has_ended
     *
     * @return Tournament
     */
    public function addTournament(
        Administrator $admin,
        $name,
        \Carbon\Carbon $begin,
        \Carbon\Carbon $finish,
        $has_ended = false
    ) {
        $tournament = new Tournament();
        $tournament->created_by = $admin->id;
        $tournament->name = $name;
        $tournament->begin = $begin;
        $tournament->finish = $finish;
        $tournament->has_ended = $has_ended;
        $tournament->save();

        return $tournament;
    }

    /**
     * Updates an existing Tournament.
     *
     * @param Administrator $admin
     * @param str $name
     * @param Carbon\Carbon $begin
     * @param Carbon\Carbon $finish
     * @param bool $has_ended
     * @param str $newName
     * 
     * @return Tournament
     */
    public function updateTournament(
        Administrator $admin,
        $name,
        \Carbon\Carbon $begin = null,
        \Carbon\Carbon $finish = null,
        $has_ended = false,
        $newName = null
    ) {
        $tournament = $this->retrieveTournament($admin, $name);

        if ($newName)
            $tournament->name = $newName;
        if ($begin)
            $tournament->begin = $begin;
        if ($finish)
            $tournament->finish = $finish;
        $tournament->has_ended = $has_ended;

        $tournament->save();

        return $tournament;
    }

    /**
     * Removes an existing Tournament.
     *
     * @param Administrator $admin
     * @param str $name
     *
     * @return boolean
     */
    public function removeTournament(
        Administrator $admin,
        $name
    ) {
        return $this->retrieveTournament($admin, $name)
            ->delete();
    }

    /**
     * Attaches a new player into the
     * tournament.
     *
     * @param $admin
     * @param $name
     * @param Player
     *
     * @return boolean
     */
    public function attachPlayer(
        Administrator $admin,
        $name,
        Player $player
    ) {
        $this->retrieveTournament($admin, $name)
            ->players()
            ->attach($player->id);
        return true;
    }
  
    /**
     * Detaches a player from the
     * tournament.
     *
     * @param $admin
     * @param $name
     * @param Player
     *
     * @return boolean
     */
    public function detachPlayer(
        Administrator $admin,
        $name,
        Player $player
    ) {
        $this->retrieveTournament($admin, $name)
            ->players()
            ->detach($player->id);
        return true;
    }

    /**
     * Method responsible for getting
     * the desired tournament.
     *
     * @param Administrator $admin
     * @param str $name
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return Tournament
     */
    private function retrieveTournament(
        Administrator $admin,
        $name
    ) {
        return Tournament::where('name', $name)
            ->where('created_by', $admin->id)
            ->firstOrFail();
    }
}

