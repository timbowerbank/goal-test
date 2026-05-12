<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class GoalAtomLog extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'completed_at',
    ];

    // *** goalAtom
    // Relationship - allows us to use $goalAtomLog->goalAtom->title
    public function goalAtom():BelongsTo {
        return $this->belongsTo(GoalAtom::class);
    }

    // *** assistedBy ***
    // Relationship - allows us to use $goalAtomLog->assistedBy->full_name
    public function assistedBy():BelongsTo {
        return $this->belongsTo(User::class, 'assisted_by_user_id');
    }

    protected function casts():array {
        return [
            'completed_at' => 'datetime',
        ];
    }
}
