<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for the Swiss Service
 */
class SwissServiceFacade extends Facade
{
    /**
     * Registers the Swiss Facade.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Swiss';
    }
}
