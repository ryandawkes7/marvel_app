<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CharacterTrait extends Model
{
    use HasFactory;

    public function characters() :HasMany
    {
        return $this->hasMany('characters', 'id', 'character_id');
    }
    
    public function traits() :HasMany
    {
        return $this->hasMany('traits', 'id', 'trait_id');
    }
}
