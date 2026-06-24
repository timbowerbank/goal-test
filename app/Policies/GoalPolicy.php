<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Goal;
use App\Models\Home;
use App\Enums\HomeStatus;
use App\Enums\GoalStatus;
use App\Enums\ClientStatus;

class GoalPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    // *** view() ***
    public function view(User $user, Goal $goal, string $home_id):bool {

        $currentHome = $goal->client->home; 

        // check role
        if($user->carer) {

            // check that clients home is the same home as the carer
            // Home must be active
            // Goal must be active or draft
            // client must be active
            // client must belong to home
            return $user->carer->homes()->where('id', $home_id)->exists()
                && $currentHome->home_status === HomeStatus::Active
                && in_array($goal->goal_status, [GoalStatus::Active, GoalStatus::Draft])
                && $goal->client->client_status === ClientStatus::Active;

        } else if ($user->manager) {

            // check that goal must belong to same home as manager
            // Home must be active
            // Goal must be active or draft
            // client must be active
            return $user->manager->homes()->where('id', $home_id)->exists()
                && $currentHome->home_status === HomeStatus::Active
                && in_array($goal->goal_status, [GoalStatus::Active, GoalStatus::Draft])
                && $goal->client->client_status === ClientStatus::Active;

        } else {

            return false;

        }

    }
}
