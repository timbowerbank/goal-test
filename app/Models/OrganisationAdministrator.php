<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\OrganisationAdministratorStatus;


class OrganisationAdministrator extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [];

    // *** user ***
    // relationship - allows us to use $organisationAdministrator->user->full_name;
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    // *** organisation ***
    // relationship - allows us to use $organisationAdministrator->organisation->organisation_name
    public function organisation(): BelongsTo {
        return $this->belongsTo(Organisation::class);
    }

    // *** verifiedBy ***
    // relationship - allows us to use $organisationAdministrator->verifiedBy->full_name
    public function verifiedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'verified_by_user_id');
    }

    // *** statusUpdatedBy() ***
    // relationship - allows us to use $organisationAdministrator->statusUpdatedBy->full_name
    public function statusUpdatedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'status_updated_by_user_id');
    }

    protected function casts():array{
        return [
            'is_verified' => 'boolean',    
            'verified_at' => 'datetime',
            'administrator_status' => OrganisationAdministratorStatus::class,
            'status_updated_at' => 'datetime',
        ];
    }
}
