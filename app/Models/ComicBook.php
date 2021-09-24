<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ComicBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'release_date',
    ];

    public function characters() :BelongsToMany
    {
        return $this->belongsToMany(Character::class, CharacterComic::class, 'comic_id', 'character_id');
    }

    public function writers() :BelongsToMany
    {
        return $this->belongsToMany(ComicWriter::class, 'comic_writer_pivot', 'comic_book_id', 'comic_writer_id');
    }

}
