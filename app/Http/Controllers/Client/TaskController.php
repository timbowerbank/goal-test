<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Home;
use App\Models\Goal;
use App\Models\GoalTask;
use App\Models\User;
use App\Models\Client;
use App\Enums\TaskStatus;
use App\Enums\GoalStatus;

class TaskController extends Controller
{

    // *** index() ***
    // show all tasks for a client

    // middleware guarantees that
    // user is authenticated
    // and verified and active
    // and belongs to the active organisation

    // scopes ensure that 
    // home belongs to organisation
    // client belongs to home

    // policies ensure that
    // home is active
    // client is active - this double-checking
    public function index($org_id) {

        // get the user
        $user = Auth::user();

        // find or fail the client
        $client = $user->client;

        // authorise the client
        $this->authorize('view', $client);

        // check home belongs to organisation and user belongs to home
        $home = Home::currentlyBelongsToOrganisation($org_id)
            ->findOrFail($user->client->home_id);
            
        // authorize that the home is active
        $this->authorize('view', $home);

        // load tasks, goals and user on client
        $client->load([
            'goals' => function($query){
                return $query->where('goal_status', GoalStatus::Active);
            },
            'goals.tasks' => function($query){
                return $query->whereIn('goal_task_status', [TaskStatus::NotStarted, TaskStatus::InProgress]);
            },
            'user',
        ]);

        // flatten the tasks into a variable and then sort by due_at
        $tasks = $client->goals->flatMap(fn($goal) => $goal->tasks);
        $sortedTasks = $tasks->sortBy(fn($task) => $task->due_at ?? Carbon::maxValue());

        // return the view
        return view('client.tasks')
            ->with('org_id', $org_id)
            ->with('client', $client)
            ->with('tasks', $sortedTasks);

    }


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
