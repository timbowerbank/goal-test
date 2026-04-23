<?php

namespace App\Services;

use App\Models\User;
use App\Enums\ManagerStatus;

class OrganisationAccessService {

    // *** managerBelongsToOrganisation() ***
    public function managerBelongsToOrganisation(User $user, int $org_id) {

        $manager = $user->manager;

        // check manager is in the manager table
        if(!$manager) {
            return false;
        }

        // check they are verified
        if(!$manager->is_verified){
            return false;
        }

        // check the manager is active
        if($manager->manager_status !== ManagerStatus::Active) {
            return false;
        }

        // must have an active home in the requested organisation
        return $manager->homes()
                ->wherePivotNull('ended_at')
                ->whereHas('organisation', function($query) use ($org_id){
                    $query->where('organisations.id', $org_id);
                })
                ->exists();
    }
}