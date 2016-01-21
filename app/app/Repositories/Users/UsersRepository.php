<?php

namespace App\Repositories\Users;

use App\Models\User;

/**
 * Implementation of User repo.
 */
class UsersRepository implements IUserRepository
{

    /**
     * Adds an user into the DB
     *
     * @param str $email
     * @param str $password
     *
     * @return User
     */
    public function addUser($email, $password)
    {
        // ...
        return null;
    }

}

