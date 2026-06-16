<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Client;
use App\Enums\ClientStatus;

class ClientPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // *** read() ***
    public function read(User $user, Client $client): bool {
        // check role
        if($user->carer) {

            // only authorise:
            // if carer belongs to same home
            // if client status is active
            return $user->carer->homes()->where('id', $client->home_id)->exists()
                && $client->client_status === ClientStatus::Active;



        } else if ($user->manager) {

            // needs updating
            return true;

        } else {

        // needs updating
            return true;
        }


    }
}
