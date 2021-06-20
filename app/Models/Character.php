<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
