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
        for($i = 0; $i < $count; $i++) {
            $currentFakePlayer = m::mock(
                'App\\Models\\Player'
            );
            $currentFakePlayer
                ->shouldReceive('getAttribute')
                ->with('id')
                ->zeroOrMoreTimes()
                ->andReturn($i);
            $fakePlayers[] = $currentFakePlayer;
        }
        return $fakePlayers;
    }
}

