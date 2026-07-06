<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Enums\ManagerStatus;
use App\Models\Manager;
use App\Models\Goal;
use App\Models\GoalTask;

class ManagerController extends Controller
{
    // *** index() ***
    // show all managers for the organisation

    // middleware guarantees that
    // org admin is authenticated
    // and verified and active
    // is an org admin
    // and that they belong to the organisation
    // the organisation is active
    public function index($org_id) {

        $organisation = Organisation::with([
            'homes' => function($query){
                return $query->orderBy('home_name');
            },
            'homes.managers' => function($query){
                return $query->join('users', 'managers.user_id', '=', 'users.id')
                        ->where('manager_status', ManagerStatus::Active)
                        ->orderBy('users.surname')
                        ->select('managers.*');
            },
            'homes.managers.user'
        ])
            ->findOrFail($org_id);

        // flatten to a single deduplicated list, ordered by surname
        $managers = $organisation->homes
            ->flatMap(fn($home) => $home->managers)
            ->unique('id')
            ->sortBy(fn($manager) => $manager->user->surname);

        return view('organisation-admin.managers')
            ->with('organisation', $organisation)
            ->with('managers', $managers);
    }


    // *** show() ***
    // show one manager
    // middleware guarantees that
    // org admin is authenticated
    // and verified and active
    // is an org admin
    // and that they belong to the organisation
    // the organisation is active

    // scope ensures that the manager belongs to the organisation

    // policy ensures that the manager status is active
    public function show($org_id, $manager_id) {

        $manager = Manager::currentlyBelongsToOrganisation($org_id)
            ->findOrFail($manager_id);

        // authorise to view this manager
        $this->authorize('view', $manager);

        // get the user id for the manager
        $managerUserId = $manager->user_id;

        // load relationships on Manager
        $manager->load([
            'user',
            'verifiedBy',
            'homes' => function($query){
                return $query->orderBy('home_name');
            }
        ]);

        // managers can only belong to one organisation, so no org scoping needed here
        $completedTasksCount = GoalTask::where('completed_with_user_id', $managerUserId)->count();
        $completedGoalsCount = Goal::where('goal_completed_with_user_id', $managerUserId)->count();

        return view('organisation-admin.manager')
            ->with('manager', $manager)
            ->with('completedTasksCount', $completedTasksCount)
            ->with('completedGoalsCount', $completedGoalsCount)
            ->with('org_id', $org_id);
    }

}
