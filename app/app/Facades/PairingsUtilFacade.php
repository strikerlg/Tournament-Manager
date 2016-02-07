<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for the Pairings
 * Handler.
 */
class PairingsUtilFacade extends Facade
{
    /**
     * Registers the Pairins Handler.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Pairings';
    }
}
