<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\TaskStatus;
use App\Enums\TaskPriority;

class GoalTask extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'due_at',
        'completed_at',
        'archived_at',
        'goal_task_status',
    ];

    // *** goal ***
    // Relationship - allows us to call $task->goal->title
    public function goal():BelongsTo {
        return $this->belongsTo(Goal::class);
    }

    // *** comments ***
    // Relationship - allows us to call $goalTask->comments
    public function comments():HasMany {
        return $this->hasMany(GoalTaskComment::class);
    }

    // *** taskEvents ***
    // Relationship - allows us to call $goalTask->taskEvents
    public function taskEvents():HasMany {
        return $this->hasMany(GoalTaskEvent::class);
    }

    // *** assignedTo ***
    // Relationship - allows us to call $task->assignedTo->full_name
    public function assignedTo():BelongsTo {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    // *** completedWith ***
    // Relationship - allows us to call $task->completedWith->full_name
    public function completedWith():BelongsTo {
        return $this->belongsTo(User::class, 'completed_with_user_id');
    }

    // *** archivedBy ***
    // Relationship - allows us to call $task->archivedBy->full_name
    public function archivedBy():BelongsTo {
        return $this->belongsTo(User::class, 'archived_by_user_id');
    }

    // *******************
    // *** SCOPES ********
    // *******************

    // *** scopeForGoal() ***
    public function scopeForGoal($query, $goalId) {
        return $query->where('goal_id', $goalId);
    }

    // ******************
    // *** CASTS ********
    // ******************

    protected function casts():array {
        return [
            'completed_at' => 'datetime',
            'due_at' => 'datetime',
            'archived_at' => 'datetime',
            'priority' => TaskPriority::class,
            'goal_task_status' => TaskStatus::class,
        ];
    }

}
