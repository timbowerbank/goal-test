<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Home;
use App\Enums\GoalStatus;
use App\Enums\TaskStatus;

class DashboardController extends Controller
{
    // middleware guarantees that user
    // is authenticated
    // is a client
    // belongs to an active organisation

    // scope checks that home belongs to organisation
    
    // policy checks that home is active
    public function index($org_id) {

        // get the user
        $user = Auth::user();

        // check the home of the client belongs to the organisation
        $home = Home::currentlyBelongsToOrganisation($org_id)
        ->findOrFail($user->client->home->id);

        // check that the client's home is active
        $this->authorize('view', $home);

        // get the client
        $client = Client::with([
            'user',
            'home',
            'goals' => function($query) {
                return $query->where('goal_status', GoalStatus::Active);
            },
            'goals.tasks' => function($query) {
                return $query->whereIn('goal_task_status', [TaskStatus::NotStarted, TaskStatus::InProgress]);
            }
        ])
        ->confirmClientBelongsToHome($home->id)
        ->findOrFail($user->client->id);

        // flatten the tasks into a variable and then sort by due_at
        $tasks = $client->goals->flatMap(fn($goal) => $goal->tasks);
        $sortedTasks = $tasks->sortBy(fn($task) => $task->due_at ?? Carbon::maxValue());

        // sort the goals
        $goals = $client->goals;
        $sortedGoals = $goals->sortBy(fn($goal) => $goal->achieve_by ?? Carbon::maxValue());


        return view('client.dashboard')
            ->with('client', $client)
            ->with('tasks', $sortedTasks)
            ->with('goals', $sortedGoals)
            ->with('org_id', $org_id);
    }
}
