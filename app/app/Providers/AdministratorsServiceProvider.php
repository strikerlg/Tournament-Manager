<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * AdministratorsService service provider.
 */
class AdministratorsServiceProvider extends ServiceProvider
{
    /**
     * Binds the Admin service
     * implementation.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Admin',
            'App\\Services\\Administrators\\AdministratorsService'
        );
    }
}

