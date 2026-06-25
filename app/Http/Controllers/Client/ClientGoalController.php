<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Enums\TaskStatus;
use App\Models\User;
use App\Models\Home;
use App\Models\Goal;

class ClientGoalController extends Controller
{
    // *** show() ***
    // show a goal for a client
    // middleware guarantees that
    // user is authenticated
    // user is validated and active
    // user is a client
    // user belongs to an organisation

    // scopes ensure that the clients home belongs to an organisation

    // policy ensures home is active
    // policy ensures that goal is active
    public function show($org_id, $goal_id) {
        // get the user
        $user = Auth::user();

        // verify home
        $home = Home::currentlyBelongsToOrganisation($org_id)
            ->findOrFail($user->client->home->id);

        // authorise policy - check home is active
        $this->authorize('view', $home);

        // not using confirmBelongsToHome($home->id) as this is effectively done with Home above

        // goal
        $goal = Goal::with([
            'client.user',
            'createdBy',
            'tasks' => function($query) {
                return $query->whereIn('goal_task_status', [TaskStatus::NotStarted, TaskStatus::InProgress]);
            },
            'notes'
        ])
            ->forClient($user->id)
            ->findOrFail($goal_id);

        // check that the goal is active
        $this->authorize('view', [$goal, $home->id]);

        // sort tasks by due date
        $sortedTasks = $goal->tasks->sortBy(fn($task) => $task->due_at ?? Carbon::maxValue());

        return view('client.goal')
            ->with('goal', $goal)
            ->with('tasks', $sortedTasks)
            ->with('org_id', $org_id);

    }
}
