<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Home;
use App\Models\Goal;
use App\Models\GoalTask;
use App\Models\User;

class TaskController extends Controller
{
    // *** show() ***
    // show a task for a client
    // middleware guarantees that client is
    // authenticated
    // verified and active
    // belongs to the organisation
    // organisation is active

    // scopes ensure that 
    // client belongs to home
    // home belongs to organisation
    // goal belongs to the client

    // policies ensure that home is active
    // goal is active
    public function show($org_id, $goal_id, $task_id) {

        // get the user
        $user = Auth::user();

        // get the corresponding client
        $client = $user->client;

        // check that the client belongs to a home and the home belongs to an organisation
        $home = Home::currentlyBelongsToOrganisation($org_id)
            ->findOrFail($client->home_id);

        // check policies - Home and Goal
        $this->authorize('view', $home);

        // check the goal belongs to this user
        $goal = Goal::forClient($user->id)
            ->findOrFail($goal_id);

        // authorise goal
        $this->authorize('view', [$goal, $home->id]);

        // get the task
        $task = GoalTask::with([
                'goal',
                'comments',
                'assignedTo',
            ])
            ->forGoal($goal->id)
            ->findOrFail($task_id);

        // authorise the task
        $this->authorize('view', $task);
    
        // return the view
        return view('client.task')
            ->with('org_id', $org_id)
            ->with('goal', $goal)
            ->with('home', $home)
            ->with('task', $task)
            ->with('user', $user);
    }
}
