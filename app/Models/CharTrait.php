<?php

namespace App\Models;

use Database\Factories\Test\TraitFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CharTrait extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'traits';

    protected static function newFactory()
    {
        return TraitFactory::new();
    }

    protected $fillable = [
        'name',
        'description'
    ];

    public function characters() :BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'character_trait', 'trait_id', 'character_id');
    }
}
