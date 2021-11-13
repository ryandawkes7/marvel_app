<?php

namespace App\Models;

use Database\Factories\Test\DirectorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Director extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'dob',
        'image'
    ];
    
    protected static function newFactory()
    {
        return DirectorFactory::new();
    }

    public function movies() :BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_director', 'director_id', 'movie_id');
    }
}
