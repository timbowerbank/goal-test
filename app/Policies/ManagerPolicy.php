<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Manager;
use App\Enums\ManagerStatus;

class ManagerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // *** view() ***
    public function view(User $user, Manager $manager, string $regionId="") {
        if($user->organisationAdministrator) {
            // check if manager is active
            return $manager->manager_status === ManagerStatus::Active;

        } else if($user->regionalOperator) {
            // check if regional operator is active and verified
            $regionalOperator = $user->regionalOperator;
            
            return  $regionalOperator.is_verified
                    && $regionalOperator.ro_status === RegionalOperatorStatus::Active
                    && $regionalOperator->regions()->where('regions.id', $regionId)->exists();
        } else {
            return false;
        }
    }
}
