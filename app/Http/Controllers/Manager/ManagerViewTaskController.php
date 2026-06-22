<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoalTask;
use App\Models\Home;
use App\Models\Carer;
use App\Models\Goal;
use App\Models\Client;

// middleware guarantees that
// manager is authenticated
// belongs to the organisation
// is validated and active



class ManagerViewTaskController extends Controller
{
    // *** viewTaskForCarer() ***
    // viewing a task for a carer

    // middleware guarantees that
    // manager is authenticated
    // belongs to the organisation
    // is validated and active

    // scopes check that
    // home belongs to organisation
    // carer belongs to home
    // confirm that the task is assigned to the carer

    // policy checks that
    // manager belongs to same home as goal
    // goal is active
    // home is active
    // client is active at the home
    public function viewTaskForCarer($org_id, $home_id, $carer_id, $task_id) {

        // validate that the home in the URL belongs to the organisation in the URL
        $home = Home::currentlyBelongsToOrganisation($org_id)->findOrFail($home_id);

        // check that the carer belongs to this home
        $carer = Carer::carerBelongsToHome($home_id)->findOrFail($carer_id);
        $task = GoalTask::with([
           'goal',
           'goal.client.user',
           'goal.home',
           'comments',
           'comments.createdBy',
           'assignedTo',
           'completedWith' 
        ])->confirmTaskAssignedTo($carer->user_id)->findOrFail($task_id);

        // authorise the manager to view the task
        $this->authorize('view', $task);

        return view('manager.task')
            ->with('task', $task)
            ->with('org_id', $org_id)
            ->with('home_id', $home_id)
            ->with('carer_id', $carer_id);
    }

    // *** viewTaskForGoal() ***
    // viewing a task for a goal

    // scopes ensure that
    // home belongs to organisation
    // client belongs to home
    // goal belongs to the client
    // task belongs to the goal

    // policies ensure that
    // manager belongs to the home of the task
    // if the goal is active
    // if the home is active
    // if client is active
    public function viewTaskForGoal($org_id, $home_id, $client_id, $goal_id, $task_id) {
        
        // validation checks to stop anyone constructing URLs
        $home = Home::currentlyBelongsToOrganisation($org_id)->findOrFail($home_id);
        
        // validate whether goal belongs to a client
        $client = Client::confirmClientBelongsToHome($home_id)->findOrFail($client_id);

        // validate whether goal belongs to client
        $goal = Goal::forClient($client->user_id)->findOrFail($goal_id);

        $task = GoalTask::with([
            'goal',
            'goal.client',
            'goal.home',
            'comments',
            'assignedTo',
            'completedWith'
        ])->forGoal($goal_id)->findOrFail($task_id);


        // authorize the GoalTaskPolicy for manager
        $this->authorize('view', $task);

        return view('manager.task')
                ->with('task', $task)
                ->with('org_id', $org_id)
                ->with('home_id', $home_id);
    }
}
