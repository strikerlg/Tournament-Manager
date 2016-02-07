<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * PairignsHandler service provider.
 */
class PairingsServiceProvider extends ServiceProvider
{
    /**
     * Binds the Parings Util
     * to the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Pairings',
            'App\\Utils\\PairingsHandler\\PairingsHandler'
        );
    }
}
