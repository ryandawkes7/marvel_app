<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    // @NOTE: bottom four id's need to be removed - belongsToMany(), not belongsTo() (requires relational table)

    protected $fillable = [
        'alias',
        'real_name',
        'sex',
        'thumb_url',
        'morality',
        'type_id',
    ];
}
