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
     * Setup method
     */
    public function setup()
    {
        parent::setup();
        // $this->beginTransaction();
    }

    /**
     * Parent method
     */
    public function teardown()
    {
        parent::teardown();
        // $this->endTransaction();
    }
}

