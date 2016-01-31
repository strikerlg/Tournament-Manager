<?php

namespace App\Services\Administrators;

use App\Repositories\Administrators\IAdministratorsRepository;

class AdministratorsService
{
    /**
     * @var IAdministratorsRepository
     */
    protected $repo;

    /**
     * Constructor.
     */
    public function __construct(
        IAdministratorsRepository $repo
    ) {
        $this->repo = $repo;
    }

    /**
     * Gets the logged admin.
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return Administrator
     */
    public function getLogged()
    {
        $user = \Auth::user();
        return $this->repo->getAdministrator(
            $user
        );
    }

}

