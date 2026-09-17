<?php

namespace App\Http\Controllers\RegionalOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GoalTask;
use App\Models\Region;
use App\Enums\GoalStatus;
use App\Enums\TaskStatus;
use App\Enums\ClientStatus;
use App\Enums\HomeStatus;



class TaskController extends Controller
{
    // *** show() ***
    // middleware guarantees that
    // user is authenticated
    // user is active and verified
    // user belongs to organisation
    // organisation is active

    // scopes ensure that
    // region belongs to organisation

    // RO belongs to region
    // is active and verified
    // task belongs to goal->home->which is active and belongs to region
    public function show($org_id, $region_id, $carer_id, $task_id) {

        // check region belongs to organisation
        $region = Region::regionBelongsToOrganisation($org_id)
        ->findOrFail($region_id);

        // authorise the user to ensure that they belong to the region and are verified and active
        $this->authorize('view', $region);

        // get the task and eager load other dependencies
        $task = GoalTask::whereIn('goal_tasks.goal_task_status', [TaskStatus::InProgress, TaskStatus::NotStarted])
                        ->whereHas('goal', function($q1) use ($region_id){
                            return $q1  ->whereIn('goals.goal_status', [GoalStatus::Active, GoalStatus::Draft])
                                        ->whereHas('client', function($q2){
                                            return $q2->where('clients.client_status', ClientStatus::Active);
                                        })
                                        ->whereHas('home', function($q3) use($region_id){
                                            return $q3  ->where('homes.home_status', HomeStatus::Active)
                                                        ->where('homes.region_id', $region_id);
                                        });
                        })
                        ->with([
                            'comments',
                            'goal.home',
                            'goal.client.user'
                        ])
                        ->findOrFail($task_id);
        
                        
        // authorise that the user is allowed to view the task
        $this->authorize('view', [$task, $region_id]);
        


        return view('regional-operator.task')
                ->with('task', $task)
                ->with('org_id', $org_id);
    }
}
