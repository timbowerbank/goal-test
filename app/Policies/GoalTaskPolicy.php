<?php

namespace App\Policies;

use App\Models\User;
use App\Models\GoalTask;
use App\Enums\GoalStatus;
use App\Enums\HomeStatus;
use App\Enums\ClientStatus;

class GoalTaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    // *** view() ***
    public function view(User $user, GoalTask $task):bool {

        // check role
        if($user->carer) {

            // eager load any missing relationships
            $task->loadMissing([
                'goal',
                'goal.home',
                'goal.client'
            ]);

            // Only authorise reading:
            // If the carer belongs to the home. 
            // If the task belongs to an active goal at the home 
            // If the home is active. 
            // The goal belongs to an active client at the home.
            return $user->carer->homes()->where('id', $task->goal->home_id)->exists()
                    && $task->goal->goal_status === GoalStatus::Active
                    && $task->goal->home->home_status === HomeStatus::Active
                    && $task->goal->client->client_status === ClientStatus::Active;

        } else if ($user->manager) {
            
            // Only authorise reading:
            // If manager belongs to same home as goal
            // If goal is active, or draft
            // If home is active
            // If Client is active at the home
            return $user->manager->homes()->where('id', $task->goal->home_id)->exists()
                    // && $task->goal->goal_status === GoalStatus::Active
                    && in_array($task->goal->goal_status, [GoalStatus::Active, GoalStatus::Draft], true)
                    && $task->goal->home->home_status === HomeStatus::Active
                    && $task->goal->client->client_status === ClientStatus::Active;

        } else {
            return false;
        }
        
        
    }
}
