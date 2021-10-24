<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comic extends Model
{
    use HasFactory;

    protected $fillable = [
        'comic_book_id',
        'title',
        'description',
        'issue_number',
        'volume_number',
        'release_date'
    ];

    protected $with = ['characters', 'covers'];

    public function covers() :HasMany
    {
        return $this->hasMany(ComicCover::class, 'comic_id', 'id');
    }

    public function comicBook() :BelongsTo
    {
        return $this->belongsTo(ComicBook::class, 'comic_book_id', 'id');
    }

    public function characters() :BelongsToMany
    {
        return $this->belongsToMany(Character::class, CharacterComic::class, 'comic_id', 'character_id', 'id', 'id');
    }
}