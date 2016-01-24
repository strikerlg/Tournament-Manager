<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Administrator model implementation
 */
class Administrator extends Model
{
    /**
     * @var string
     */
    protected $table = 'administrators';

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

    /**
     * One to Many relationship with
     * the Tournaments model.
     *
     * @return Relation
     */
    public function tournaments()
    {
        return $this->hasMany('App\\Models\\Tournament');
    }
}

