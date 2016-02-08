<?php

use \Mockery as m;

if (! function_exists('getFakePlayers')) {
    /**
     * Returns an array of fake players.
     *
     * @param int $count
     *
     * @return array
     */
    function getFakePlayers(
        $count = 1
    ) {
        $fakePlayers = [];
        for($index = 0; $index < $count; $index++) {
            $currentFakePlayer = m::mock(
                'App\\Models\\Player'
            );
            $currentFakePlayer
                ->shouldReceive('getAttribute')
                ->with('id')
                ->zeroOrMoreTimes()
                ->andReturn($index * rand(1, 10));
            $fakePlayers[] = $currentFakePlayer;
        }
        return $fakePlayers;
    }
}

if (! function_exists('getFakePairings')) {
    /**
     * Returns an array of fake pairings.
     *
     * @param int $count
     *
     * @return array
     */
    function getFakePairings(
        $count = 1,
        $withByes = false
    ) {
        $fakePairings = [];
        for($index = 0; $index < $count; $index++) {
            $playersCount = $withByes ? rand(1, 2) : 2;
            $fakePairings[] = getFakePlayers($playersCount);
        }
        return $fakePairings;
    }
}

