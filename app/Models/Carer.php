<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\CarerStatus;

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
    public function updatedBy():BelongsTo {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

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
