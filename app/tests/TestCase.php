<?php

class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     *
     * Configures the database used by the
     * Integration tests.
     * 
     */
    public function configureDatabase()
    {
        // TODO: Configure the sqlite db Connection to be used.
        return null;
    }

}
