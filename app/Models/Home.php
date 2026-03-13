<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\HomeStatus;

class Home extends Model
{
    // tell Laravel to use ULIDs and soft deletes
    use HasUlids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'home_name',
        'address_1',
        'address_2',
        'city',
        'postcode',
        'telephone',
        'website_url',

    ];

    // *** createdBy ***
    // Relationship - allows us to do $home->createdBy->full_name
    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    // *** updatedBy ***
    // Relationship - allow us to do $home->updatedBy->full_name
    public function updatedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    // cast organisation_status to enum OrganisationStatus
    // so we can use: $home->home_status = HomeStatus::Active;
    protected function casts():array {
        return [
            'home_status' => HomeStatus::class,
            'deleted_at' => 'datetime',
        ];
    }
}
