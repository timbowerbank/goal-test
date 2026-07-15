<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Region;
use App\Enums\RegionalOperatorStatus;

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

        if($regionalOperator) {
            return  $regionalOperator->is_verified && 
                    $regionalOperator->ro_status === RegionalOperatorStatus::Active &&
                    $regionalOperator->regions()->where('id', $region->id)->exists();
        }

        return false;
    }
}
