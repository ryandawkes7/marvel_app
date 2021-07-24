<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CharTrait extends Model
{
    use HasFactory;
    protected $table = 'traits';

    public function characters() :BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'character_trait', 'trait_id', 'character_id');
    }
}
