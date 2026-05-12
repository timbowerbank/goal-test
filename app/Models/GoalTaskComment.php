<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class GoalTaskComment extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'comment'
    ];

    // *** task ***
    // Relationship - allows us to call $comment->task->title
    public function task():BelongsTo {
        return $this->belongsTo(GoalTask::class);
    }

    // *** createdBy ***
    // Relationship - allows us to call $comment->createdBy->full_name
    public function createdBy():BelongsTo {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}
