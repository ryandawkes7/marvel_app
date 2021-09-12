<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'alias',
        'real_name',
        'sex',
        'thumb_url',
        'morality',
        'type_id',
    ];

    public function type() :BelongsTo
    {
        return $this->belongsTo(CharacterType::class, 'type_id', 'id');
    }

    public function traits() :BelongsToMany
    {
        return $this->belongsToMany(CharTrait::class, 'character_trait', 'character_id', 'trait_id');
    }

    public function skills() :BelongsToMany
    {
        return $this->belongsToMany(Skill::class)->withPivot('value');
    }

    public function movies() :BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'character_movie', 'character_id', 'movie_id');
    }
}
