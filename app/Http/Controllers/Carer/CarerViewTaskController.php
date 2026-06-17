<?php

namespace App\Http\Controllers\Carer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carer;
use App\Models\Home;
use App\Models\GoalTask;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Enums\TaskPriority;

class CarerViewTaskController extends Controller
{
    public function index(Request $request, $org_id, $home_id) {

        // withActiveTasksForHome comes with:
        // tasks, 
        // tasks.goal
        // tasks.goal.client.user
        // tasks.goal.home
        $carer = Carer::carerBelongsToHome($home_id)
                        ->withActiveTasksForHome($home_id)
                        ->findOrFail(Auth::user()->carer->id);

        // withActiveClients comes with:
        // clients
        // clients.user
        $home = Home::currentlyBelongsToOrganisation($org_id)
                    ->withActiveClients()
                    ->findOrFail($home_id);

        

        // create array of filter types
        $taskFilterTypes = ['all', 'due', 'overdue'];

        // access the $request object to get query params
        $query = $request->query();
        $filterType = $query['filterType'];
        $client = $query['client'];
        $sortBy = $query['sortBy'] ?? 'due_at';
        $sortDir = $query['sortDir'] ?? 'asc';
        
        // filter the tasks as per the query params
        $tasksByFilterType = $this->filterTasks($carer->tasks, $query);
        $tasksFilteredByClient = $this->filterByClient($client, $tasksByFilterType);

        // sort as per the query params
        $tasksSorted = $this->sortTasks($tasksFilteredByClient, $sortBy, $sortDir);

        return view('carer.tasks')
                ->with('carer', $carer)
                ->with('tasks', $tasksSorted)
                ->with('filter_types', $taskFilterTypes)
                ->with('filter_selected', $filterType)
                ->with('client_selected', $client)
                ->with('org_id', $org_id)
                ->with('home', $home)
                ->with('sort_by', $sortBy)
                ->with('sort_dir', $sortDir);
    }


    // *** show() ***
    public function show($org_id, $home_id, $task_id) {

        // get the Goal task
        $task = $this->getTask($task_id);

        // use the read policy for GoalTasks
        $this->authorize('read', $task);

        return view('carer.task')
            ->with('task', $task)
            ->with('org_id', $org_id)
            ->with('home_id', $home_id);
    }

    // *** showForGoal() ***
    public function showForGoal($org_id, $home_id, $client_id, $goal_id, $task_id) {
        $task = $this->getTask($task_id);

        // use the read policy for GoalTasks
        $this->authorize('read', $task);

        return view('carer.task')
            ->with('task', $task)
            ->with('org_id', $org_id)
            ->with('home_id', $home_id);
    }



    // ***********************
    // *** UTILITY METHODS ***
    // ***********************

    // *** filterTasks() ***
    private function filterTasks(Collection $tasks, array $query):Collection {

        $filterType = $query['filterType'];
        $client = $query['client'];

        // get a now Carbon object
        $now = Carbon::now();

        if($filterType === 'all') {
            // get all all tasks
            $filteredTasks = $tasks;

        } elseif ($filterType === 'overdue') {
            // get overdue tasks
            $filteredTasks = $tasks->where('due_at', '<', $now);

        } else {
            // must be due in a week
            $filteredTasks = $tasks->whereBetween('due_at', [$now, $now->copy()->endOfWeek()]);
        }

        // return the filteredTasks
        return $filteredTasks;

    }

    private function filterByClient(string $queryString, Collection $filteredTasks):Collection {
        if($queryString === 'all') {
            return $filteredTasks;
        } else {
            return $filteredTasks->filter(function($task) use ($queryString){
                return $task->goal->client->id == $queryString;
            });
        }
    }

    // private function sortTasks(Collection $tasks, string $sortBy, string $sortDir):Collection {
    //     if($sortDir === 'asc') {
    //         return $tasks->sortBy($sortBy);
    //     } else {
    //         return $tasks->sortByDesc($sortBy);
    //     }
    // }

    private function sortTasks(Collection $tasks, string $sortBy, string $sortDir): Collection {
    
        if($sortBy === 'priority') {
            $priorityOrder = ['high' => 1, 'medium' => 2, 'low' => 3];
            $sorted = $tasks->sortBy(function($task) use ($priorityOrder) {
                return $priorityOrder[$task->priority->value] ?? 99;
            });
            return $sortDir === 'asc' ? $sorted : $sorted->reverse();
        }

        return $sortDir === 'asc' 
            ? $tasks->sortBy($sortBy) 
            : $tasks->sortByDesc($sortBy);
    }


    private function getTask(string $task_id) {
        return $task = GoalTask::with(
            [
                'goal',
                'goal.client.user',
                'comments',
                'comments.createdBy',
                'completedWith'
            ]
        )
        ->findOrFail($task_id);
    }

}
