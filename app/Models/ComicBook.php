<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ComicBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'release_date',
    ];

    public function writers() :BelongsToMany
    {
        return $this->belongsToMany(ComicWriter::class, 'comic_writer_pivot', 'comic_book_id', 'comic_writer_id');
    }

    public function comicIssues() :HasMany
    {
        return $this->hasMany(Comic::class, 'comic_book_id', 'id');
    }

    public function covers() :HasManyThrough
    {
        return $this->hasManyThrough(ComicCover::class, Comic::class, 'comic_book_id', 'comic_id', 'id', 'id');
    }

}
