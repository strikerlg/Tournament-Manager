<?php

namespace App\Repositories\Administrators;

use App\Repositories\IRepository;
use App\Models\User;
use App\Models\Administrator;

/**
 * Administrators Repository implementation.
 */
class AdministratorsRepository implements
    IAdministratorsRepository,
    IRepository
{
    /**
     * Gets the desired model.
     *
     * @param $id
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return Model
     */
    public function get($id)
    {
        return Administrator::findOrFail($id);
    }

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
        $admin = new Administrator();
        $admin->user_id = $user->id;
        $admin->nickname = $nickname;
        $admin->save();

        return $admin;
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
        return Administrator::where('nickname', $nickname)
            ->firstOrFail()
            ->delete();
    }
}

