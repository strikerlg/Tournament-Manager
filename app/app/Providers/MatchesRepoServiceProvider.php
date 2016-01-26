<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Matches repository service provider.
 */
class MatchesRepoServiceProvider extends ServiceProvider
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
            'App\\Repositories\\Matches\\IMatchesRepository',
            'App\\Repositories\\Matches\\MatchesRepository'
        );
    }
}
