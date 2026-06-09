<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\CarerStatus;
use App\Enums\TaskStatus;
use App\Enums\GoalStatus;


class Carer extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [];

    // *** user ***
    // Relationship - allows us to use $carer->user->full_name;
    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }

    // *** verifiedBy ***
    // Relationship - allows us to use $carer->verifiedBy->full_name;
    public function verifiedBy():BelongsTo {
        return $this->belongsTo(User::class, 'verified_by_user_id');
    }

    // *** updatedBy ***
    // Relationship - allows us to use $carer->updatedBy->full_name;
    public function statusUpdatedBy():BelongsTo {
        return $this->belongsTo(User::class, 'carer_status_updated_by_user_id');
    }

    // *** homes ***
    // Relationship - allows us to use $carer->homes
    public function homes():BelongsToMany {
        return $this->belongsToMany(Home::class, 'carer_home', 'carer_id', 'home_id' )
        ->withPivot(
           'started_at',
           'ended_at',
           'created_by_user_id',
           'updated_by_user_id' 
        )
        ->withTimestamps();
    }

    // *** tasks ***
    // Relationship - allows us to call $carer->tasks
    public function tasks():HasMany {
        return $this->hasMany(GoalTask::class, 'assigned_to_user_id', 'user_id');
    }


    // *******************
    // *** SCOPES ********
    // *******************

    // *** scopeCarerBelongsToHome() ***
    public function scopeCarerBelongsToHome($query, $homeId) {
        return $query->whereHas('homes', function($q) use ($homeId){
            $q  ->where('carer_home.home_id', $homeId)
                ->whereNull('carer_home.ended_at');

        });
    }


    // *** scopeWithTasksForHome ***
    public function scopeWithTasksForHome($query, $homeId) {
        return $query->with(
            [
                'tasks' => function($q) use ($homeId) {
                    $q->whereHas('goal', function($q2) use($homeId){
                        $q2->where('home_id', $homeId);
                    });
                }
            ]
        );
    }

    // *** scopeWithActiveTasks() ***
    public function scopeWithActiveTasks($query) {
        return $query->with(
            [
                'tasks' => function($q) {
                    $q->whereIn('goal_task_status', [
                        TaskStatus::NotStarted,
                        TaskStatus::InProgress,
                    ]);
                }
            ]
        );
    }

    // *** scopeWithActiveTasksForHome() ***
    public function scopeWithActiveTasksForHome($query, $homeId) {
        return $query->with(
            [
                'tasks' => function($q) use ($homeId){
                    $q->whereHas('goal', function($q2) use ($homeId){
                        $q2->where('home_id', $homeId)
                        ->where('goal_status', GoalStatus::Active);
                        
                    })
                    ->whereIn('goal_task_status', [
                            TaskStatus::NotStarted,
                            TaskStatus::InProgress
                    ]);
                },
                'tasks.goal',
                'tasks.goal.client.user',
                'tasks.goal.home',
            ]
        );
    }


    // ******************
    // *** CASTS ********
    // ******************

    // *** casts ***
    protected function casts(): array {
        return [
            'is_verified' => 'boolean',
            'carer_status' => CarerStatus::class,
            'verified_at' => 'datetime',
            'carer_status_updated_at' => 'datetime',

        ];
    }

}
