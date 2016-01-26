<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Match model implementation
 */
class Match extends Model
{
    /**
     * @var string
     */
    protected $table = 'matches';

    /**
     * @var fillable
     */
    protected $fillable = [
        'tournament_id',
        'first_player_id',
        'second_player_id',
        'winner',
        'begin',
        'finish',
        'created_by',
    ];

    /**
     * One to many relationship between
     * Tournament and Match.
     *
     * @return Relation
     */
    public function tournament()
    {
        return $this->belongsTo('App\\Models\\Tournament');
    }

    /**
     * One to many relationship between
     * Player and Match.
     *
     * @return Relation
     */
    public function firstPlayer()
    {
        return $this->belongsTo('App\\Models\\Player');
    }

    /**
     * One to many relationship between
     * Player and Match.
     *
     * @return Relation
     */
    public function secondPlayer()
    { 
        return $this->belongsTo('App\\Models\\Player');
    }

    /**
     * One to many relationship between
     * Player and Match.
     *
     * @return Relation
     */
    public function winner()
    {
        return $this->belongsTo('App\\Models\\Player'); 
    }

    /**
     * One to many relationship between
     * Administrator and Match.
     *
     * @return Relation
     */
    public function createdBy()
    { 
        return $this->belongsTo('App\\Models\\Administrator');
    }
}

