<?php

namespace Tests\Rankings\Unitary;

use App\Services\RankingsService;
use \Mockery as m;

class RankingsServiceUnitTest extends \TestCase
{
    /**
     * @var RankingsService
     */
    protected $service;

    /**
     * @var Mockery
     */
    protected $fakeRankingsRepo;

    /**
     * @var Mockery
     */
    protected $fakePlayersRepo;

    /**
     * Setup method.
     */
    public function setup()
    {
        parent::setup();
        $this->fakeRankingsRepo = m::mock(
            'App\\Repositories\\Rankings\\IRankingsRepository'
        );
        $this->fakeRankingsRepo = m::mock(
            'App\\Repositories\\Players\\IPlayersRepository'
        );
        $this->service = new RankingsService(
            $this->fakeRankingsService,
            $this->fakePlayersService
        );
    }

    /**
     * Basic is working test.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }
}

