<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for the Administrators
 * Service.
 */
class AdministratorsServiceFacade extends Facade
{
    /**
     * Registers the admin service.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Admin';
    }
}

