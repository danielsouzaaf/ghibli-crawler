<?php

namespace GhibliCrawler\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
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
        'id', 'title', 'description', 'director', 'producer', 'release_date', 'rt_score', 'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'url',
    ];

    public function characters()
    {
        return $this->belongsTo(Character::class);
    }
}
