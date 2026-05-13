<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class ActivityType extends Model
{
    use HasUlids;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    // *** goals ***
    // Relationship - allows us to call $activityType->goals
    public function goals():BelongsToMany {
        return $this->belongsToMany(Goal::class);
    }
}
