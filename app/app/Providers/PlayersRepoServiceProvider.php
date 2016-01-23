<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Players repository service provider.
 */
class PlayersRepoServiceProvider extends ServiceProvider
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
            'App\\Repositories\\Players\\IPlayersRepository',
            'App\\Repositories\\Players\\PlayersRepository'
        );
    }
}

