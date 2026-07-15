<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Home;
use App\Enums\HomeStatus;

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

            return $user->client->home->home_status === HomeStatus::Active;

        } else if ($user->organisationAdministrator) {

            return $user->organisationAdministrator->organisation->homes()
                        ->where('id', $home->id)->exists()
                        
                    && $home->home_status === HomeStatus::Active;


        } else if($user->regionalOperator) {

            $regionalOperator = $user->regionalOperator;

            return $regionalOperator->regions()->where('id', $regionId)->exists()
                    && $user->is_verified
                    && $user->ro_status === RegionalOperatorStatus::Active;


        } else {

            return false;
        }
        

    }
}
