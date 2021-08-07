<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieMovieSaga extends Model
{
    use HasFactory;

    protected $table = 'movie_movie_saga';

    protected $fillable = [
        'movie_id',
        'movie_saga_id',
        'created_at',
        'updated_at'
    ];
}
