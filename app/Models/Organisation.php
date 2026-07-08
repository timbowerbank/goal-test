<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\OrganisationStatus;

class Organisation extends Model
{
    // tell Laravel to use ULIDs and soft deletes
    use HasUlids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'organisation_name',
        'address_1',
        'address_2',
        'city',
        'postcode',
        'telephone',
        'website_url',
        'organisation_status',
        'created_by_user_id',
    ];

    // *** createdBy() ***
    // Relationship - allows you to use $organisation->createdBy->full_name
    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    // *** updatedBy() ***
    // Relationship - allows you to use $organisation->updatedBy->full_name
    public function updatedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    // *** administrators() ***
    // Relationship - allows you to use $organisation->administrators
    public function administrators(): HasMany {
        return $this->hasMany(OrganisationAdministrator::class);
    }

    // *** homes ***
    // Relationship - via pivot table
    public function homes():BelongsToMany {
        return $this->belongsToMany(Home::class, 'home_organisation', 'organisation_id', 'home_id')
        ->wherePivotNull('ended_at')
        ->withPivot(
            'started_at',
            'ended_at',
            'created_by_user_id',
            'updated_by_user_id',
        )
        ->withTimestamps();
    }

    // *** regions ***
    // Relationship - allows us to call $organisation->regions
    public function regions():HasMany {
        return $this->hasMany(Region::class);
    }

    // *** organisationReporters ***
    // Relationship - allows us to call $organisation->organisationReporters
    public function organisationReporters():HasMany {
        return $this->hasMany(OrganisationReporter::class);
    }


    // cast organisation_status to enum OrganisationStatus
    // so we can use: $organisation->organisation_status = OrganisationStatus::Active;
    protected function casts(): array {
        return [
            'organisation_status' => OrganisationStatus::class,
            'deleted_at' => 'datetime',
        ];
    }
}
