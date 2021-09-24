<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ComicWriter extends Model
{
    use HasFactory;

    public function writers() :BelongsToMany
    {
        return $this->belongsToMany(ComicBook::class, 'comic_writer_pivot', 'comic_writer_id', 'comic_book_id');
    }
}
