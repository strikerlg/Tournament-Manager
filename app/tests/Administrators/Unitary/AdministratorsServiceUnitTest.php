<?php

namespace Tests\Administrators\Unitary;

use \Mockery as m;
use App\Services\Administrators\AdministratorsService;

class AdministratorsServiceUnitTest extends \TestCase
{
    /**
     * @var AdministratorsService
     */
    protected $service;

    /**
     * @var Mockery
     */
    protected $fakeAdministratorsRepo;

    /**
     * @var Mockery
     */
    protected $fakeUsersRepo;

    /**
     * Setup method.
     */
    public function setup()
    {
        parent::setup();

        $this->fakeAdministratorsRepo = m::mock(
            'App\\Repositories\\Administrators\\IAdministratorsRepository'
        );
        $this->service = new AdministratorsService(
            $this->fakeAdministratorsRepo
        );
    }

    /**
     * Test is working.
     */
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests if the service get admin
     * method interacts correctly.
     */
    public function testServiceGetLogged()
    {
        $fakeUser = m::mock(
            'App\\Models\\User'
        );
        $fakeAdmin = m::mock(
            'App\\Mdodels\\Administrator'
        );
        \Auth::shouldReceive('user')
            ->once()
            ->andReturn($fakeUser);
        $this->fakeAdministratorsRepo
            ->shouldReceive('getAdministrator')
            ->withArgs([
                m::type('App\\Models\\User')
            ])
            ->once()
            ->andReturn($fakeAdmin);
        $admin = $this->service->getLogged();
        $this->assertEquals($fakeAdmin, $admin);
    }
}

