<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Users Repository provider
 */
class UsersRepoServiceProvider extends ServiceProvider
{
 
    /**
     * Registers the UsersRepository
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\\Repositories\\Users\\IUsersRepository,
            'App\\Repositories\\Users\\UsersRepository
        );
    }

}

