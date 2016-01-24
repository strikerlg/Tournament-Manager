<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Games repository service provider.
 */
class GamesRepoServiceProvider extends ServiceProvider
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
            'App\\Repositories\\Games\\IGamesRepository',
            'App\\Repositories\\Games\\GamesRepository'
        );
    }
}

