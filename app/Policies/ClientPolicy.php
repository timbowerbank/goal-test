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

    // *** view() ***
    public function view(User $user, Client $client): bool {
        // check role
        if($user->carer) {

            // only authorise:
            // if carer belongs to same home
            // if client status is active
            return $user->carer->homes()->where('id', $client->home_id)->exists()
                && $client->client_status === ClientStatus::Active;



        } else if ($user->manager) {

            // only authorise:
            // if manager belongs to same home
            return $user->manager->homes()->where('id', $client->home_id)->exists()
                    && $client->client_status === ClientStatus::Active;

        } else {

        // needs updating
            return true;
        }


    }
}
