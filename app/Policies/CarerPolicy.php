<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Carer;
use App\Models\Home;
use App\Enums\CarerStatus;
use App\Enums\RegionalOperatorStatus;

class CarerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // *** view() ***
    public function view(User $user, Carer $carer, string $home_id):bool {

        // check for roles
        if($user->carer) {
            // todo
            return false;

        } else if($user->manager) {
            return $user->manager->homes()->where('id', $home_id)->exists()
                    && $carer->carer_status === CarerStatus::Active;


        } else if($user->regionalOperator) {

            // does the regional operator's region belong to the same region as the home id passed in
            $home = Home::findOrFail($home_id);
            $homeRegionId = $home->region_id;
            $regionalOperator = $user->regionalOperator;

            return $regionalOperator->regions()->where('id', $homeRegionId)->exists() &&
                    $carer->is_verified &&
                    $carer->carer_status === CarerStatus::Active &&
                    $regionalOperator->is_verified &&
                    $regionalOperator->ro_status === RegionalOperatorStatus::Active;

        } else {
            return false;
        }
    }
}
