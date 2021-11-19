<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Actor extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [ 
        'name',
        'dob',
        'image_url'
    ];

    public function movies() :BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_actor', 'actor_id', 'movie_id');
    }
}
