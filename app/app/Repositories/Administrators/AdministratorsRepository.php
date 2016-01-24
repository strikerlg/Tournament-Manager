<?php

namespace App\Repositories\Administrators;

use App\Models\User;
use App\Models\Administrators;

/**
 * Administrators Repository implementation.
 */
class AdministratorsRepository implements IAdministratorsRepository
{
    /**
     * Adds a new admin into the db.
     *
     * @param User $user
     * @param str $nickname
     *
     * @return Administrator
     */
    public function addAdministrator(
        User $user,
        $nickname
    ) {
        return null;
    }

    /**
     * Removes the specified admin.
     *
     * @param str $nickname
     *
     * @return boolean
     */
    public function removeAdministrator(
        $nickname
    ) {
        return false;
    }
}

