<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Organisation;

use App\Enums\OrganisationStatus;
use App\Enums\OrganisationReporterStatus;

class OrganisationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // *** view() ***
    public function view(User $user, Organisation $organisation) {

        if($user->organisationReporter) {
            $organisationReporter = $user->organisationReporter;

            return $organisationReporter->organisation_id === $organisation->id &&
                    $organisation->organisation_status === OrganisationStatus::Active &&
                    $organisationReporter->is_verified &&
                    $organisationReporter->org_reporter_status === OrganisationReporterStatus::Active;

        } else {
            return false;
        }

    }
}
