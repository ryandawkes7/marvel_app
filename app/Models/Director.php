<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Director extends Model
{
    use HasFactory;

    public function movies() :BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_director', 'director_id', 'movie_id');
    }
}
