<?php

namespace Tests\Matches\Unitary;

use \Mockery as m;
use App\Services\Matches\MatchesService;

class MatchesServiceUnitTest extends \TestCase
{
    /**
     * @var MathcesService
     */
    protected $service;

    /**
     * @var Mockery
     */
    protected $fakeMatchesRepo;

    /**
     * Setup Method.
     */
    public function setup()
    {
        parent::setup();
        
        $this->fakeMatchesRepo = m::mock(
            'App\\Repositories\\Matches\\IMatchesRepository'
        );
        $this->service = new MatchesService(
            $this->service
        );
    }

    /**
     * Test is working.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }
}

