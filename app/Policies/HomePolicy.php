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

    // *** readClients() ***
    public function readClients(User $user, Home $home):bool {
        // check role
        if($user->carer) {

            return $user->carer->homes()->where('id', $home->id)->exists()
                    && $home->home_status === HomeStatus::Active;

        } else if ($user->manager) {

            return true;
        } else {

            return true;
        }
        

    }
}
