<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * SwissService service provider.
 */
class SwissServiceProvider extends ServiceProvider
{
    /**
     * Binds the Swiss service
     * implementation.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Swiss',
            'App\\Services\\Swiss\\SwissService'
        );
    }
}
