<?php

namespace App\Http\Controllers\Carer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carer;
use App\Models\Home;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;

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
        
        // filter the tasks as per the query params
        $tasksByFilterType = $this->filterTasks($carer->tasks, $query);
        $tasksFilteredByClient = $this->filterByClient($client, $tasksByFilterType);

        return view('carer.tasks')
                ->with('carer', $carer)
                ->with('tasks', $tasksFilteredByClient)
                ->with('filter_types', $taskFilterTypes)
                ->with('filter_selected', $filterType)
                ->with('client_selected', $client)
                ->with('org_id', $org_id)
                ->with('home', $home);
    }


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



}
