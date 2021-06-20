<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterType extends Model
{
    use HasFactory;

    public function characters()
    {
        return $this->hasMany(Character::class, 'type_id', 'id');
    }
}