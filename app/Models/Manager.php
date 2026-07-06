<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\ManagerStatus;


class Manager extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'user_id',
    ];

    // *** user ***
    // relationship - allows us to use $manager->user->full_name
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    // *** verifiedBy ***
    // relationship - allows us to use $manager->verifiedBy->full_name
    public function verifiedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'verified_by_user_id');
    }

    // *** updatedBy ***
    // relationship - allows us to use $manager->updatedBy->full_name
    public function statusUpdatedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'manager_status_updated_by_user_id');
    }

    // *** homes ***
    // Relationship - allows us to use $manager->homes
    public function homes(): BelongsToMany {
        return $this->belongsToMany(Home::class, 'home_manager', 'manager_id', 'home_id')
        ->wherePivotNull('ended_at')
        ->withPivot(
            'started_at', 
            'ended_at',
            'created_by_user_id',
            'updated_by_user_id'
        )
        ->withTimestamps();
    }


    // *** SCOPES ***

    // *** scopeCurrentlyBelongsToOrganisation() ***
    public function scopeCurrentlyBelongsToOrganisation($query, $orgId) {
        return $query->whereHas('homes.organisations', function($q) use($orgId){
            return $q->where('organisations.id', $orgId);
        });
    }


    // *** casts ***
    protected function casts(): array {
        return [
            'manager_status' => ManagerStatus::class,
            'is_verified' => 'boolean',
            'verified_at' => 'datetime',
            'manager_status_updated_at' => 'datetime',
        ];
    }

}
