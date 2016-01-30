<?php

namespace Tests\Tournaments\Unitary;

use \Mockery as m;
use App\Services\TournamentsService;

class TournamentsServiceUnitTest extends \TestCase
{
    /**
     * @var TournamentsService
     */
    protected $service;

    /**
     * @var ITournamentsRepository
     */
    protected $fakeTournamentsRepo;

    /**
     * Setup method.
     */
    public function setup()
    {
        parent::setup();
        $this->fakeTournamentsRepo = m::mock(
            'App\\Repositories\\Tournaments\\ITournamentsRepository'
        );
        $service = new TournamentsService(
            $this->fakeTournamentsRepo
        );
    }

    /**
     * Base is working test.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }
}

