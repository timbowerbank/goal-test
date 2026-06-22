<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Carer;
use App\Enums\CarerStatus;

class CarerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // *** read() ***
    public function read(User $user, Carer $carer, string $home_id):bool {

        // check for roles
        if($user->carer) {
            // todo
            return false;

        } else if($user->manager) {
            return $user->manager->homes()->where('id', $home_id)->exists()
                    && $carer->carer_status === CarerStatus::Active;

        } else {
            return true;
        }
    }
}
