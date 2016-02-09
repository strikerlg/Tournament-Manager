<?php

namespace App\Repositories;

/**
 * General interface all repositories
 * should follow.
 */
interface IRepository
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
    public function get($id);
}

