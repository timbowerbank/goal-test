<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoalTask;
use App\Models\Home;
use App\Models\Carer;

class ManagerViewTaskController extends Controller
{
    // *** viewTaskForCarer() ***
    // viewing a task for a carer
    public function viewTaskForCarer($org_id, $home_id, $carer_id, $task_id) {

        // validate that the home in the URL belongs to the organisation in the URL
        $home = Home::currentlyBelongsToOrganisation($org_id)->findOrFail($home_id);
        // check that the carer belongs to this home
        $carer = Carer::carerBelongsToHome($home_id)->findOrFail($carer_id);
        $task = GoalTask::with([
           'goal',
           'goal.client.user',
           'comments',
           'comments.createdBy',
           'assignedTo',
           'completedWith' 
        ])->confirmTaskAssignedTo($carer->user_id)->findOrFail($task_id);

        return view('manager.task')
            ->with('task', $task)
            ->with('orgId', $org_id)
            ->with('homeId', $home_id)
            ->with('carerId', $carer_id);
    }

    // *** viewTaskForGoal() ***
    // viewing a task for a goal
    public function viewTaskForGoal($org_id, $home_id, $client_id, $goal_id, $task_id) {
        // validation checks to stop anyone constructing URLs
        $home = Home::currentlyBelongsToOrganisation($org_id)->findOrFail($home_id);
        $goal = Goal::forClient($client_id)->findOrFail($goal_id);

        $task = GoalTask::with([
            'goal',
            'goal.client',
            'goal.home',
            'comments',
            'assignedTo',
            'completedWith'
        ])->forGoal($goal_id)->findOrFail($task_id);



        return view('manager.task')
                ->with('task', $task)
                ->with('orgId', $org_id)
                ->with('homeId', $home_id);
    }
}
