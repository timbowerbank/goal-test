<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalCostItem extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'cost',
    ];

    // *** goal ***
    // Relationship - Allows us to call $goalCostItem->goal->title
    public function goal():BelongsTo {
        return $this->belongsTo(Goal::class);
    }

    // *** createdBy ***
    // Relationship - allows us to call $goalCostItem->createdBy->full_name
    public function createdBy():BelongsTo {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    // *** updatedBy ***
    // Relationship - allows us to call $goalCostItem->updatedBy->full_name
    public function updatedBy():BelongsTo {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }



}
