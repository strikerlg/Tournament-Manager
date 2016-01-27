<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Rankings repository service provider.
 */
class RankingsRepoServiceProvider extends ServiceProvider
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
            'App\\Repositories\\Rankings\\IRankingsRepository',
            'App\\Repositories\\Rankings\\RankingsRepository'
        );
    }
}
