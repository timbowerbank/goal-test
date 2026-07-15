<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Home;
use App\Enums\HomeStatus;
use App\Enums\RegionalOperatorStatus;

class HomePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // *** view() ***
    public function view(User $user, Home $home, string $regionId =""):bool {
        // check role
        if($user->carer) {

            return $user->carer->homes()->where('id', $home->id)->exists()
                    && $home->home_status === HomeStatus::Active;

        } else if ($user->manager) {

            return $user->manager->homes()->where('id', $home->id)->exists()
                    && $home->home_status === HomeStatus::Active;

        } else if ($user->client) {

            return $user->client->home_id === $home->id 
                    && $user->client->home->home_status === HomeStatus::Active;

        } else if ($user->organisationAdministrator) {

            return $user->organisationAdministrator->organisation->homes()
                        ->where('id', $home->id)->exists()
                        
                    && $home->home_status === HomeStatus::Active;


        } else if($user->regionalOperator) {

            $regionalOperator = $user->regionalOperator;

            return $home->region_id === $regionId 
                    && $regionalOperator->regions()->where('id', $regionId)->exists()
                    && $regionalOperator->is_verified
                    && $regionalOperator->ro_status === RegionalOperatorStatus::Active;


        } else {

            return false;
        }
        

    }
}
