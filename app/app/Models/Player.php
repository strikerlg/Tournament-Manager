<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Player model implementation
 */
class Player extends Model
{
    /**
     * @var string
     */
    protected $table = 'players';

    /** 
     * @var fillable
     */
    protected $fillabel = [
        'nickname', 'user_id'
    ];

    /**
     * One to one relationship with
     * the user model.
     *
     * @return Relation
     */
    public function user()
    {
        return $this->belongsTo('App\\Models\\User');
    }
}

