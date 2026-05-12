<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\GoalTaskEventType;

class GoalTaskEvent extends Model
{
    use HasUlids;

    public $timestamps = false;
    protected $fillable = [];

    // *** task ***
    // Relationship - allows us to call $goalTaskEvent->task->title
    public function task():BelongsTo {
        return $this->belongsTo(GoalTask::class);
    }

    // *** performedBy ***
    // Relationship - allows us to call $goalTaskEvent->performedBy->full_name
    public function performedBy():BelongsTo {
        return $this->belongsTo(User::class, 'performed_by_user_id');
    }

    protected function casts():array {
        return [
            'event_type' => GoalTaskEventType::class,
            'performed_at' => 'datetime',
            'old_value' => 'array',
            'new_value' => 'array',

        ];
    }

}
