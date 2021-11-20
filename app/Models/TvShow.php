<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TvShow extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'episode_count',
        'season_count',
        'logo_url',
        'description',
        'in_mcu',
        'mcu_phase_id',
        'release_date'
    ];

    public function phase() :BelongsTo
    {
        return $this->belongsTo(McuPhase::class, 'mcu_phase_id', 'id');
    }

    public function actors() :BelongsToMany
    {
        return $this->belongsToMany(Actor::class, 'tv_show_actor', 'tv_show_id', 'actor_id');
    }
}
