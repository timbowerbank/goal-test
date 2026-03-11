<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    // cast organisation_status to enum OrganisationStatus
    // so we can use: $organisation->home_status = HomeStatus::Active;
    protected function casts():array {
        return [
            'home_status' => HomeStatus::class,
        ];
    }
}
