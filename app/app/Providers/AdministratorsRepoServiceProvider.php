<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Administrators repository service provider.
 */
class AdministratorsRepoServiceProvider extends ServiceProvider
{
    /**
     * Binds the repo interface with the desired
     * implementation.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\\Repositories\\Administrators\\IAdministratorsRepository',
            'App\\Repositories\\Administrators\\AdministratorsRepository'
        );
    }
}

