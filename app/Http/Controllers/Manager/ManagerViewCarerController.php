<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carer;
use App\Enums\TaskStatus;
use App\Models\Home;


// middleware guarantees that
// manager is authenticated
// belongs to the organisation
// is validated and active

class ManagerViewCarerController extends Controller
{
    // scopes check that
    // home belongs to organisation
    // carer belongs to the home

    // policy checks that
    // carer is active
    // manager belongs to home  
    public function index($org_id, $home_id, $carer_id) {

        // validate that home belongs to organisation
        $home = Home::currentlyBelongsToOrganisation($org_id)->findOrFail($home_id);

        // TODO add a date method to tasks to retrieve latest
        $carer = Carer::with([
            'tasks',
            'tasks.goal',
            'tasks.goal.client.user',
        ])->carerBelongsToHome($home_id)->findOrFail($carer_id);

        // authorize the manager
        $this->authorize('view', [$carer, $home->id]);

        return view('manager.carer')
            ->with('org_id', $org_id)
            ->with('home_id', $home_id)
            ->with('carer', $carer)
            ->with('notStarted', $carer->tasks->where('goal_task_status', TaskStatus::NotStarted)->sortBy('due_at'))
            ->with('inProgress', $carer->tasks->where('goal_task_status', TaskStatus::InProgress)->sortBy('due_at'))
            ->with('completed', $carer->tasks->where('goal_task_status', TaskStatus::Complete)->sortBy('due_at'));
    }
}
