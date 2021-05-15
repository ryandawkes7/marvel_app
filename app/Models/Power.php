<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Power extends Model
{
    use HasFactory;

    // @NOTE: bottom four id's need to be removed - belongsToMany(), not belongsTo() (requires relational table)?

    protected $fillable = [
        'name',
        'character_id',
        'type_id'
    ];
}
