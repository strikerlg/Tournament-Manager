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
            $fakePlayers[] = m::mock(
                'App\\Models\\Player'
            );
        }
        return $fakePlayers;
    }
}

