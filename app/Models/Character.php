<?php

namespace GhibliCrawler\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /*
     * The attributes that should be mass assignable.
     */

    protected $fillable = [
        'id', 'name', 'gender', 'eye_color', 'hair_color', 'release_date', 'rt_score'
    ];
}
