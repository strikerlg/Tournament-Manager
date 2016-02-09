<?php

namespace App\Repositories\Users;

use App\Repositories\IRepository;
use App\Models\User;

/**
 * Implementation of User repo.
 */
class UsersRepository implements
    IUsersRepository,
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
        return User::findOrFail($id);
    }

    /**
     * Adds an user into the DB
     *
     * @param str $email
     * @param str $name
     * @param str $password
     *
     * @return User
     */
    public function addUser(
        $email,
        $name,
        $password
    ) {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        return $user;
    }

}

