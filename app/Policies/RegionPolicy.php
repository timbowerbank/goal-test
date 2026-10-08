<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Region;
use App\Enums\RegionalOperatorStatus;
use App\Enums\OrganisationReporterStatus;

class RegionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // *** view() ***
    public function view(User $user, Region $region):bool {

        $regionalOperator = $user->regionalOperator;
        $organisationReporter = $user->organisationReporter;

        if($regionalOperator) {

            return  $regionalOperator->is_verified && 
                    $regionalOperator->ro_status === RegionalOperatorStatus::Active &&
                    $regionalOperator->regions()->where('id', $region->id)->exists();

        } else if($organisationReporter) {

            return $region->organisation->id === $organisationReporter->organisation->id &&
                    $organisationReporter->is_verified &&
                    $organisationReporter->org_reporter_status === OrganisationReporterStatus::Active;

        } else {
            
            return false;
        }

    }
}
