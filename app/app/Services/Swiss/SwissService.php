<?php

namespace App\Services\Swiss;

use App\Services\Players\PlayersService;
use App\Services\Matches\MatchesService;

class SwissService
{
    /**
     * @var PlayersService
     */
    protected $playersService;

    /**
     * @var MatchesService
     */
    protected $matchesService;

    /**
     * Constructor.
     *
     * @param PlayersService $playersService
     * @param MatchesService $matchesService
     */
    public function __construct(
        PlayersService $playersService,
        MatchesService $matchesService
    ) {
        $this->playersService = $playersService;
        $this->matchesService = $matchesService;
    }

    /**
     * Generates the pairings for
     * a given tournament.
     *
     * @param int $tournamentID
     * @param Carbon $begin
     * @param Carbon $finish
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return array
     */
    public function pairings(
        $tournamentID,
        \Carbon\Carbon $begin = null,
        \Carbon\Carbon $finish = null
    ) {
        // TODO: Get the players based on their ranking score.
        // TODO: Iterate through all score ranges generating
        // matches for each one.
        $players = $this->playersService->getPlayers(
            $tournamentID
        );
        $pairings = $this->generatePairings(
            $players
        );
        $matches = $this->registerMatches(
            $pairings,
            $tournamentID,
            $begin,
            $finish
        );

        return $matches;
    }

    /**
     * Calculates the number of rounds
     * given a number of players.
     *
     * @param int $tournamentID
     *
     * @return int
     */
    public function roundsCount($tournamentID)
    {
        $playersCount = $this->playersService->getPlayersCount(
            $tournamentID
        );
        return floor(log($playersCount, 2));
    }

    /**
     * Generates the pairings with random
     * Players.
     *
     * @param array $players
     *
     * @return array
     */
    private function generatePairings(
        $players
    ) {
        $pairings = [];

        $i = count($players);
        while($i > 0) {

            $randomElements = array_rand($players, 2);
            $keys = array_keys($randomElements);

            unset($players[$keys[0]]);
            unset($players[$keys[1]]);

            $currentPair = array_values($randomElements);
            $pairings[] = $currentPair;

            $i -= 2;
        }
        return $pairings;
    }

    /**
     * Registers a new match when a pairings
     * array is given.
     *
     * @param array $pairings
     * @param int $tournamentID
     * @param Carbon $begin
     * @param Carbon $finish
     *
     * @return array
     */
    private function registerMatches(
        $pairings,
        $tournamentID,
        \Carbon\Carbon $begin = null,
        \Carbon\Carbon $finish = null
    ) {
        if (! $begin) {
            $begin = \Carbon\Carbon::now();
        }

        if (! $finish) {
            $finish = \Carbon\Carbon::tomorrow();
        }

        $matches = [];
        foreach($pairings as $pair) {
            $currentMatch = $this->matchesService->addMatch(
                $tournamentID,
                $pair[0],
                $pair[1],
                $begin,
                $finish
            );
            $matches[] = $currentMatch;
        }
        return $matches;
    }
}

