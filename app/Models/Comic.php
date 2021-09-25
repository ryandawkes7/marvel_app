<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comic extends Model
{
    use HasFactory;

    public function covers() :HasMany
    {
        return $this->hasMany(ComicCover::class, 'comic_id', 'id');
    }
}