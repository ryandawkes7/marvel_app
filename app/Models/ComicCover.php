<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicCover extends Model
{
    use HasFactory;

    protected $fillable = [
        'comic_id',
        'cover_url',
        'is_variant',
        'variant_issue'
    ];
}
