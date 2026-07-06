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
    public function view(User $user, Manager $manager) {
        if($user->organisationAdministrator) {
            // check if manager is active
            return $manager->manager_status === ManagerStatus::Active;


        } else {
            return false;
        }
    }
}
