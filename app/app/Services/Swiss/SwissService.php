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
        $rankedPlayers = $this->playersService->getRankedPlayers(
            $tournamentID
        );
        // TODO: This should be a call to a service in charge
        // of generating pairs.
        $pairings = $this->getRankedPairings(
            $rankedPlayers,
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
     * Generates the pairings for each ranking interval
     * with random Players for each ranking.
     *
     * @param array $rankedPlayers
     * @param int $tournamentID
     *
     * @return array
     */
    private function getRankedPairings(
        $rankedPlayers,
        $tournamentID
    ) {
        $rankedPairings = [];
        $numberOfRounds = $this->roundsCount($tournamentID);

        for ($index = 0; $index < $numberOfRounds; $index++) {

            if (! array_key_exists($index, $rankedPlayers)) {
                continue;
            }

            $pairingsForRound = $this->getRandomPairings(
                $rankedPlayers[$index]
            );
            $rankedPairings = array_merge(
                $rankedPairings,
                $pairingsForRound
            );
        }
        return $rankedPairings;
    }

    /**
     * Generates random pairings from a given
     * set of players.
     *
     * @param array $players
     *
     * @return $array
     */
    private function getRandomPairings(
        $players
    ) {
        $pairings = [];
        $playersCount = count($players);

        while($playersCount > 0) {
            $pairings[] = $this->extractRandomPair($players);
            $playersCount -= 2;
        }
        return $pairings;
    }

    /**
     * Selects and removes a random pair
     * from the given array.
     *
     * @param array $elements
     *
     * @return array
     */
    private function extractRandomPair(&$elements)
    {
        $desiredCount = count($elements) > 1 ? 2 : 1;
        $randomIndexes = array_rand(
            $elements,
            $desiredCount
        );
        
        if (! is_array($randomIndexes)) {
            $randomIndexes = [$randomIndexes];
        }

        $randomPair = array_map(
            function($index) use ($elements) {
                return $elements[$index];
            },
            $randomIndexes
        );

        foreach($randomIndexes as $index) {
            unset($elements[$index]);
        }

        return $randomPair;
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

