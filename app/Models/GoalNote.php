<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoalNote extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'note',
    ];

    // *** goal ***
    // Relation - allows us to call $goalNote->goal->title
    public function goal():BelongsTo {
        return $this->belongsTo(Goal::class);
    }

    // *** createdBy ***
    // Relationship - allows us to call $goalNote->createdBy->full_name
    public function createdBy():BelongsTo {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

}
