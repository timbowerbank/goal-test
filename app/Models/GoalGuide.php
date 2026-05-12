<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoalGuide extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'mime_type',
        'sort_order',
    ];

    // *** goal ***
    // Relationship - Allows us to call $goalGuide->goal->title
    public function goal():BelongsTo {
        return $this->belongsTo(Goal::class);
    }

    // *** createdBy ***
    // Relationship - allows us to call $goalGuide->createdBy->full_name
    public function createdBy():BelongsTo {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }


}
