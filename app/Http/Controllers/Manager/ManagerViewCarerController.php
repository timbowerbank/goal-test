<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carer;
use App\Enums\TaskStatus;

class ManagerViewCarerController extends Controller
{
    public function index($org_id, $home_id, $carer_id) {

        // TODO add a date method to tasks to retrieve latest
        $carer = Carer::with([
            'tasks',
            'tasks.goal',
            'tasks.goal.client.user',
        ])->findOrFail($carer_id);

        return view('manager.carer')
            ->with('org_id', $org_id)
            ->with('home_id', $home_id)
            ->with('carer', $carer)
            ->with('notStarted', $carer->tasks->where('goal_task_status', TaskStatus::NotStarted)->sortBy('due_at'))
            ->with('inProgress', $carer->tasks->where('goal_task_status', TaskStatus::InProgress)->sortBy('due_at'))
            ->with('completed', $carer->tasks->where('goal_task_status', TaskStatus::Complete)->sortBy('due_at'));
    }
}
