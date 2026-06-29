<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Enums\TaskStatus;
use App\Enums\GoalStatus;
use App\Models\User;
use App\Models\Home;
use App\Models\Goal;
use App\Models\Client;

class ClientGoalController extends Controller
{

    // *** index() ***
    // show all the clients goals
    // middleware guarantees that 
    // user is authenticated
    // verified and active
    // and belongs to an organisation

    // scopes confirm that
    // home belongs to organisation
    // client belongs to home
    // goals are active

    // policies confirm that
    // home is active
    public function index($org_id) {

        // get the user
        $user = Auth::user();

        // get the client
        $client = $user->client;

        // verify the home and check that the user belongs to the home
        $home = Home::currentlyBelongsToOrganisation($org_id)
            ->findOrFail($client->home_id);

        // run policy on the home
        $this->authorize('view', $home);

        // get the goals
        $client = Client::with([
                'goals' => function($query){
                    return $query->where('goal_status', GoalStatus::Active);
                },
                'user'
            ])
            ->findOrFail($client->id);

        // run the Client policy - this double-checks that the client is active
        $this->authorize('view', $client);


        return view('client.goals')
            ->with('org_id', $org_id)
            ->with('client', $client);
    }


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
