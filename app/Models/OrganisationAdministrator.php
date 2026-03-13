<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;


class OrganisationAdministrator extends Model
{
    use HasUlids;

    protected $fillable = [];

    // *** user ***
    // relationship - allows us to use $organisationAdministrator->user->full_name;
    public function user() {
        return $this->belongsTo(User::class);
    }

    // *** organisation ***
    // relationship - allows us to use $organisationAdministrator->organisation->organisation_name
    public function organisation() {
        return $this->belongsTo(Organisation::class);
    }

    // *** verifiedBy ***
    // relationship - allows us to use $organisationAdministrator->verifiedBy->full_name
    public function verifiedBy() {
        return $this->belongsTo(User::class, 'verified_by_user_id');
    }
}
