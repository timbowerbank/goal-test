<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use App\Enums\OrganisationReporterStatus;

class OrganisationReporter extends Model
{
    use HasUlids;

    protected $fillable = [
    ];

    // *** user ***
    // Relationship - allows us to call $organisationReporter->user->full_name
    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }

    // *** organisation ***
    // Relationship - allows us to call $organisationReporter->organisation->organisation_name
    public function organisation():BelongsTo {
        return $this->belongsTo(Organisation::class);
    }

    // *** verifiedByUser ***
    // Relationship - allows us to call $organisationReporter->verifiedByUser->full_name
    public function verifiedByUser():BelongsTo {
        return $this->belongsTo(User::class, 'verified_by_user_id');
    }

    // *** statusUpdatedBy ***
    // Relationship - allows us to call $organisationReporter->statusUpdatedBy->full_name
    public function statusUpdatedBy():BelongsTo {
        return $this->belongsTo(User::class, 'org_reporter_status_updated_by_user_id');
    }

    // ******************
    // *** CASTS ********
    // ******************

    protected function casts():array {
        return [
            'is_verified' => 'boolean',
            'verified_at' => 'datetime',
            'org_reporter_status' => OrganisationReporterStatus::class,
            'org_reporter_status_updated_at' => 'datetime',
        ];
    }

}
