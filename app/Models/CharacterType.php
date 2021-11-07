<?php

namespace App\Models;

use Database\Factories\Test\CharacterTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterType extends Model
{
    use HasFactory;
    protected static function newFactory()
    {
        return CharacterTypeFactory::new();
    }

    public $timestamps = false;

    protected $fillable = [
        'key',
        'type',
    ];

    public function characters()
    {
        return $this->hasMany(Character::class, 'type_id', 'id');
    }
}
