<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tournament model implementation
 */
class Tournament extends Model
{
    /**
     * @var string
     */
    protected $table = 'tournaments';

    /** 
     * @var fillable
     */
    protected $fillable = [
        'name',
        'begin',
        'finish',
        'has_ended',
        'created_by',
    ];

    /**
     * One to one relationship with
     * the Administrator model.
     *
     * @return Relation
     */
    public function createdBy()
    {
        return $this->belongsTo('App\\Models\\Administrator');
    }

    /**
     * One to Many relationship with
     * the Match model.
     *
     * @return Relation
     */
    public function matches()
    {
        return $this->hasMany('App\\Models\\Match');
    }

    /**
     * Many to Many relationship with
     * the Player model.
     *
     * @return Relation
     */
    public function players()
    {
        return $this->belongsToMany(
            'App\\Models\\Player',
            'tournaments_players'
        );
    }
}

