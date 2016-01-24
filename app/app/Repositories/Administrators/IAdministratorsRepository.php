<?php

namespace App\Repositories\Administrators;

use App\Models\Users;

/**
 * Administrators repo interface.
 */
interface IAdministratorsRepository
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
    );

    /**
     * Removes the specified admin.
     *
     * @param str $nickname
     *
     * @return boolean
     */
    public function removeAdministrator(
        $nickname
    );
}

