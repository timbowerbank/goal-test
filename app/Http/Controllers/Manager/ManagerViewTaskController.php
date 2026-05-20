<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoalTask;

class ManagerViewTaskController extends Controller
{
    public function index($org_id, $home_id, $carer_id, $task_id) {
        $task = GoalTask::with([
           'goal',
           'goal.client.user',
           'comments',
           'comments.createdBy',
           'assignedTo',
           'completedWith' 
        ])->findOrFail($task_id);

        return view('manager.task')
            ->with('task', $task)
            ->with('orgId', $org_id)
            ->with('homeId', $home_id)
            ->with('carerId', $carer_id);
    }
}
