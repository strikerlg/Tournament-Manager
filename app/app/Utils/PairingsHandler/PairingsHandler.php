<?php

namespace App\Utils\PairingsHandler;

/**
 * Class in charge of generating pairings
 * when needed.
 */
class PairingsHandler
{
    /**
     * Generates ranked pairings form the given
     * array of players.
     *
     * @param array $players
     * @param int $tournamentID
     *
     * @return array
     */
    public function ranked(
        $players,
        $tournamentID
    ) {
        $rankedPairings = [];
        $numberOfRounds = \Swiss::roundsCount($tournamentID);

        for ($index = 0; $index < $numberOfRounds; $index++) {

            if (! array_key_exists($index, $players)) {
                continue;
            }

            $pairingsForRound = $this->getRandomPairings(
                $players[$index]
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
}

