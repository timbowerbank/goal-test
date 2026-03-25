<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'created_by_user_id',
        'home_status',

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

    // *** organisation ***
    // Relationship - allows us to use $home->organisation
    public function organisation():BelongsToMany {
        return $this->belongsToMany(Organisation::class, 'home_organisation', 'home_id', 'organisation_id')
        ->withPivot(
            'started_at',
            'ended_at',
            'created_by_user_id',
            'updated_by_user_id'
        )
        ->withTimestamps();
    }

    // *** managers ***
    // Relationship - allows us to implement $home->managers
    public function managers():BelongsToMany {
        return $this->belongsToMany(Manager::class, 'home_manager', 'home_id', 'manager_id')
        ->withPivot(
            'started_at',
            'ended_at',
            'created_by_user_id',
            'updated_by_user_id'
        )
        ->withTimestamps();
    }

    // *** carers ***
    // Relationship - allows us to implement $home->carers
    public function carers():BelongsToMany {
        return $this->belongsToMany(Carer::class, 'carer_home', 'home_id', 'carer_id')
        ->withPivot(
            'started_at', 
            'ended_at', 
            'created_by_user_id',
            'updated_by_user_id'
        )
        ->withTimestamps();
    }

    // *** clients ***
    // Relationship - allows us to implement $home->clients
    public function clients():HasMany {
        return $this->hasMany(Client::class);
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
