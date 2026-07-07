<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use App\Enums\RegionalOperatorStatus;

class RegionalOperator extends Model
{
    use HasUlids;

    protected $fillable= [];

    // *** user ***
    // Relationship - allows us to use $regionalOperator->user->full_name
    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }

    // *** verifiedByUser ***
    // Relationship - allows us to use $regionalOperator->verifiedByUser->full_name
    public function verifiedByUser():BelongsTo {
        return $this->belongsTo(User::class, 'verified_by_user_id');
    }

    // *** statusUpdatedBy ***
    // Relationship - allows us to use $regionalOperator->statusUpdatedBy->full_name
    public function statusUpdatedBy():BelongsTo {
        return $this->belongsTo(User::class, 'ro_status_updated_by_user_id');
    }

    // *** regions ***
    // Relationship - allows us to use $regionalOperator->regions
    public function regions():BelongsToMany {
        return $this->belongsToMany(Region::class)
            ->withPivot([
                'created_by_user_id',
                'updated_by_user_id'
            ])
            ->withTimestamps();
    }

    // ******************
    // *** CASTS ********
    // ******************

    // *** casts() ***
    protected function casts():array {
        return [
            'is_verified' => 'boolean',
            'verified_at' => 'datetime',
            'ro_status' => RegionalOperatorStatus::class,
            'ro_status_updated_at' => 'datetime',
        ];
    }

}
