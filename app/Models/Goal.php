<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\GoalStatus;

class Goal extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'goal_type',
        'title',
        'image_url',
        'description',
        'video_url',
        'achieve_by',
        'goal_completed_at',
        'goal_status',
        'archived_at'
    ];

    // *** home ***
    // Relationship - allows us to call $goal->home->home_name
    public function home():BelongsTo {
        return $this->belongsTo(Home::class);
    }


    // *** organisation ***
    // Relationship - allows us to call $goal->organisation->organisation_name
    public function organisation():BelongsTo {
        return $this->belongsTo(Organisation::class);
    }

    // *** client ***
    // Relationship - allows us to call $goal->client->user->first_name
    public function client():BelongsTo {
        return $this->belongsTo(Client::class, 'client_user_id', 'user_id');
    }

    // *** createdBy ***
    // Relationship -  allows us to call $goal->createdBy->full_name
    public function createdBy():BelongsTo {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    // *** updatedBy ***
    // Relationship - allows us to call $goal->updatedBy->full_name
    public function updatedBy():BelongsTo {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    // *** leadBy ***
    // Relationship - allows us to call $goal->leadBy->full_name
    public function leadBy():BelongsTo {
        return $this->belongsTo(User::class, 'lead_user_id');
    }

    // *** completedWith ***
    // Relationship - Allows us to call $goal->completedWith->full_name
    public function completedWith():BelongsTo {
        return $this->belongsTo(User::class, 'goal_completed_with_user_id');
    }

    // *** archivedBy ***
    // Relationship - Allows us to call $goal->archivedBy->full_name
    public function archivedBy():BelongsTo {
        return $this->belongsTo(User::class, 'archived_by_user_id');
    }


    // *** reward ***
    // Relationship - allows us to call $goal->reward
    public function reward():HasOne {
        return $this->hasOne(Reward::class);
    }

    // *** tasks ***
    // Relationship - allows us to call $goal->tasks
    public function tasks():HasMany {
        return $this->hasMany(GoalTask::class);
    }

    // *** goalAtom ***
    // Relationship - allows us to call $goal->goalAtom->title
    public function goalAtom():HasOne {
        return $this->hasOne(GoalAtom::class);
    }

    // *** goalAtomLog ***
    // Relationship - allows us to call $goal->goalAtomLog
    public function goalAtomLog():HasManyThrough {
        return $this->hasManyThrough(GoalAtomLog::class, GoalAtom::class)
    }

    // *** goalEvents ***
    // Relationship - allows us to call $goal->goalEvents
    public function goalEvents():HasMany {
        return $this->hasMany(GoalEvent::class);
    }

    // *** goalGuides ***
    // Relationship - Allows us to call $goal->guides
    public function guides():HasMany {
        return $this->hasMany(GoalGuide::class);
    }

    protected function casts():array {
        return [
            'achieve_by' => 'datetime',
            'goal_completed_at' => 'datetime',
            'archived_at' => 'datetime',
            'goal_status' => GoalStatus::class,
        ];
    }
}
