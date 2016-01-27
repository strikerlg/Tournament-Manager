<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Ranking model implementation
 */
class Ranking extends Model
{
    /**
     * @var string
     */
    protected $table = 'rankings';

    /** 
     * @var fillable
     */
    protected $fillable  = [
        'player_id',
        'tournament_id',
        'score',
    ];

    /**
     * One to many relationship with
     * the Player model.
     *
     * @return Relation
     */
    public function player()
    {
        return $this->belongsTo('App\\Models\\Player');
    }

    /**
     * One to many relationship with
     * the tournament model.
     *
     * @return Relation
     */
    public function tournament()
    {
        return $this->belongsTo('App\\Models\\Tournament');
    }
}

