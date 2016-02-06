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
        $players = $this->playersService->getRankedPlayers(
            $tournamentID
        );
        $pairings = $this->generatePairings(
            $players,
            $tournamentID
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
     * @param array $rankedPlayers
     * @param int $tournamentID
     *
     * @return array
     */
    private function generatePairings(
        $rankedPlayers,
        $tournamentID
    ) {
        $pairings = [];
        $numberOfRounds = $this->roundsCount($tournamentID);

        // TODO: Refactor this code.
        for($i = 0; $i < $numberOfRounds; $i++) {

            if (! array_key_exists($i, $rankedPlayers)) {
                continue;
            }
            $playersForRank = $rankedPlayers[$i];
            $internalIndex = count($playersForRank);

            while($internalIndex > 0) {
                $randomElements = [];

                if (count($playersForRank) > 1) {
                    $randomIndexes = array_values(
                        array_rand(
                            $playersForRank,
                            2
                        )
                    );
                    $randomElements = array_map(
                        function($val) use ($playersForRank) {
                            return $playersForRank[$val];
                        },
                        $randomIndexes
                    );
                    unset($playersForRank[$randomIndexes[0]]);
                    unset($playersForRank[$randomIndexes[1]]);

                } else if (count($playersForRank) == 1) {
                    $randomElements[] = array_shift($playersForRank);
                }

                $currentPair = array_values($randomElements);
                $pairings[] = $currentPair;

                $internalIndex -= 2;
            }
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
            $firstPlayerID = $pair[0]->id;
            $secondPlayerID = isset($pair[1]) ? $pair[1]->id : null;
            $currentMatch = $this->matchesService->addMatch(
                $tournamentID,
                $firstPlayerID,
                $secondPlayerID,
                $begin,
                $finish
            );
            $matches[] = $currentMatch;
        }
        return $matches;
    }
}

