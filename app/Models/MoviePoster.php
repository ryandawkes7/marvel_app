<?php

namespace App\Models;

use Database\Factories\Test\MoviePosterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MoviePoster extends Model
{
    use HasFactory;
    protected static function newFactory()
    {
        return MoviePosterFactory::new();
    }

    protected $fillable = [
        'movie_id',
        'image_url',
        'user_id',
    ];

    public function movie() :BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
