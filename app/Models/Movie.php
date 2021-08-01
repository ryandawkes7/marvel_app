<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function phase() :HasOne
    {
        return $this->hasOne(McuPhase::class);
    }

    public function sagas() :BelongsToMany
    {
        return $this->belongsToMany(MovieSaga::class, 'movie_movie_saga', 'movie_id', 'movie_saga_id');
    }
}
