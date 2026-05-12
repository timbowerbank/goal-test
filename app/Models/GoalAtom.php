<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoalAtom extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'title',
        'frequency_type',
        'frequency_value',
        'total_required',
    ];

    // *** goal ***
    // Relationship - allows us to call $goal->title
    public function goal():BelongsTo {
        return $this->belongsTo(Goal::class);
    }

    // *** goalAtomLog ***
    // Relationship - allows us to call $goalAtom->goalAtomLog
    public function goalAtomLog():HasMany {
        return $this->hasMany(GoalAtomLog::class);
    }
}
