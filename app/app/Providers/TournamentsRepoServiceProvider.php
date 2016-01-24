<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Tournaments repository service provider.
 */
class TournamentsRepoServiceProvider extends ServiceProvider
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
            'App\\Repositories\\Tournaments\\ITournamentsRepository',
            'App\\Repositories\\Tournaments\\TournamentsRepository'
        );
    }
}
