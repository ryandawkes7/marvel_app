<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'director',
        'release_date',
        'in_mcu',
        'mcu_phase_id'
    ];

    public function phase() :BelongsTo
    {
        return $this->belongsTo(McuPhase::class, 'mcu_phase_id', 'id');
    }

    public function sagas() :BelongsToMany
    {
        return $this->belongsToMany(MovieSaga::class, 'movie_movie_saga', 'movie_id', 'movie_saga_id')->withPivot('movie_saga_id');
    }
    
    public function posters() :HasMany
    {
        return $this->hasMany(MoviePoster::class);
    }

    public function directors() :BelongsToMany
    {
        return $this->belongsToMany(Director::class, 'movie_director', 'movie_id', 'director_id');
    }

    public function characters() :BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'character_movie', 'movie_id', 'character_id');
    }

    public function getPosterAttribute()
    {
        return $this->posters()->first();
    }
}
