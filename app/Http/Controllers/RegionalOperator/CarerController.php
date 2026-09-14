<?php

namespace App\Http\Controllers\RegionalOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Models\Region;
use App\Models\Carer;

use App\Enums\HomeStatus;
use App\Enums\CarerStatus;
use App\Enums\TaskStatus;

class CarerController extends Controller
{
    
    // *** index() ***
    // show all carers for a region
    // middleware guarantees that
    // user is authenticated
    // user is verified and active
    // user belongs to the organisation

    // scopes ensure that 
    // region belongs to the organisation

    // policy ensures that regional operator is
    // verified, active and belongs to the region
    public function index($org_id, $region_id) {

        // verify that the region belongs to the organisation
        $region = Region::regionBelongsToOrganisation($org_id)->findOrFail($region_id);

        // authorise the user
        $this->authorize('view', $region);

        // get all carers
        $carers = Carer::join('users', 'carers.user_id', 'users.id')
                    ->where('carers.carer_status', CarerStatus::Active)
                    ->whereHas('homes', function($query) use ($region_id){
                        return $query->where('homes.home_status', HomeStatus::Active)
                                    ->where('homes.region_id', $region_id);
                    })
                    ->orderBy('users.surname')
                    ->select('carers.*')
                    ->with([
                        'user'
                    ])
                    ->get();

        


        return view('regional-operator.carers')
            ->with('org_id', $org_id)
            ->with('region', $region)
            ->with('carers', $carers);

    }


    // *** show() ***
    // show a carer
    // middleware guarantees that
    // user is authenticated
    // user is verified and active
    // user belongs to the organisation

    // scopes ensure that 
    // region belongs to the organisation

    // policy ensures that regional operator is
    // verified, active and belongs to the region

    // policy ensures that carer belongs to a home that belongs to the region
    public function show(Request $request, $org_id, $region_id, $carer_id) {

        // verify that the region belongs to the organisation
        $region = Region::regionBelongsToOrganisation($org_id)->findOrFail($region_id);

        // authorize the user
        $this->authorize('view', $region);

        // get the carer
        $carer = Carer::whereHas('homes', function($query) use($region_id){
                    return $query   ->where('homes.region_id', $region_id)
                                    ->where('homes.home_status', HomeStatus::Active);
                })
                ->where('carer_status', CarerStatus::Active)
                ->with([
                    'tasks' => function($query) use ($region_id){
                        return $query   ->whereIn('goal_task_status', [TaskStatus::InProgress, TaskStatus::NotStarted])
                                        ->whereHas('goal', function($q1) use($region_id){
                                            return $q1->whereHas('home', function($q2) use($region_id){
                                                return $q2->where('homes.region_id', $region_id);
                                            });
                                        })
                                        ->orderBy('due_at');
                    },
                    'tasks.goal.client.user',
                    'user',
                    'homes' => function($query) use($region_id) {
                        return $query->where('homes.region_id', $region_id)
                                    ->where('homes.home_status', HomeStatus::Active);
                    }
                ])
                ->findOrFail($carer_id);

        // authorize viewing this carer
        $home = $carer->homes->first();
        $this->authorize('view', [$carer, $home->id]);

        // get params from request object
        $query = $request->query();
        $filterType = $query['filterType'] ?? 'all';
        $sortBy = $query['sortBy'] ?? 'due_at';
        $sortDir = $query['sortDir'] ?? 'asc';

        // filtered the tasks
        $tasksByFilterType = $this->filterTasks($carer->tasks, $filterType);

        // sort the tasks
        $tasksSorted = $this->sortTasks($tasksByFilterType, $sortBy, $sortDir);

        // create array of filter types
        $filterTypes = ['all', 'due', 'overdue'];
        $filterSelected = $filterType;


        return view('regional-operator.carer')
            ->with('org_id', $org_id)
            ->with('region', $region)
            ->with('carer', $carer)
            ->with('filter_types', $filterTypes)
            ->with('filter_selected', $filterSelected)
            ->with('sort_dir', $sortDir)
            ->with('sort_by', $sortBy)
            ->with('tasks', $tasksSorted);
    }


    // ***********************
    // *** UTILITY METHODS ***
    // ***********************

    // *** filterTasks() ***
    private function filterTasks(Collection $tasks, string $filterBy):Collection {
        // get the carbon date for now
        $now = Carbon::now();

        if($filterBy === 'all') {
            // simply return all tasks
            $filteredTasks = $tasks;

        } else if ($filterBy === 'overdue') {
            // use Carbon and where to filter tasks 
            $filteredTasks = $tasks->where('due_at',  '<', $now);

        } else {
            // must be due
            $filteredTasks = $tasks->whereBetween('due_at', [$now, $now->copy()->endOfWeek()]);

        }

        return $filteredTasks;
    }

    // *** sortTasks() ***
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
}
