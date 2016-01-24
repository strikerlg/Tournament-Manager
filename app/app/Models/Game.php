<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Game model
 */
class Game extends Model
{
    /**
     * @var string
     */
    protected $table = 'games';

    /** 
     * @var fillable
     */
    protected $fillabel = [
        'name', 
    ];
}

