<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MovieSaga extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'created_at',
        'updated_at'
    ];

    public function movies() :BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_movie_saga');
    }
}
