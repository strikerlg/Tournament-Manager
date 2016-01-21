<?php

namespace App\Repositories\Users;

/**
 * Repository mainly used for DB interactions
 * Involving the User model.
 */
interface IUsersRepository {

    /**
     * Adds an user entity in the DB.
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
    );

}

