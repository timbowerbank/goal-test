<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\GoalEventType;

class GoalEvent extends Model
{
    use HasUlids;

    public $timestamps = false;
    protected $fillable = [];

    // *** goal ***
    // Relationship - allows us to call $goalEvent->goal->title
    public function goal():BelongsTo {
        return $this->belongsTo(Goal::class);
    }

    // *** performedBy ***
    // Relationship - allows us to call $goalEvent->performedBy->full_name
    public function performedBy():BelongsTo {
        return $this->belongsTo(User::class, 'performed_by_user_id');
    }


    

    protected function casts():array {
        return [
            'performed_at' => 'datetime',
            'event_type' => GoalEventType::class,
            'old_value' => 'array',
            'new_value' => 'array',
        ];
    }
}
