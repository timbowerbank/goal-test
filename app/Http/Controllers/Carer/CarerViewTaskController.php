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

        $home = Home::currentlyBelongsToOrganisation($org_id)
                    ->findOrFail($home_id);


        $tasks = $this->filterTasks($carer->tasks, $request);

        return view('carer.tasks')
                ->with('carer', $carer)
                ->with('tasks', $tasks)
                ->with('org_id', $org_id)
                ->with('home', $home);
    }


    // *** filterTasks() ***
    private function filterTasks(Collection $tasks, Request $request):Collection {
        // access the $request object
        $query = $request->query();
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
}
