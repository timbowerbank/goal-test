<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\TaskStatus;
use App\Models\Home;
use App\Models\Goal;

class ClientGoalController extends Controller
{
    // *** show() ***
    // add notes for middleware, scopes and policy
    public function show($org_id, $goal_id) {
        // get the user
        $user = Auth::user();

        // home
        $home = Home::currentlyBelongsToOrganisation($org_id)
            ->findOrFail($user->client->home->home_id);

        // authorise policy
        $this->authorize('view', $home);

        // goal
        $goal = Goal::with([
            'client.user',
            'createdBy.user'
            'tasks' => function($query) {
                return $query->whereIn('goal_task_status', [TaskStatus::NotStarted, TaskStatus::InProgress])
            },
            'notes'
        ])
            ->forClient($user->id)
            ->findOrFail($goal_id);


        return view('client.goal')
            ->with('goal', $goal);

    }
}
