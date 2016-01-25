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
    public function administrator()
    {
        return $this->belongTo('App\\Models\\Administrator');
    }
}

