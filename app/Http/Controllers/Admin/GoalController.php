<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Enums\GoalStatus;

class GoalController extends Controller
{
    // *** index() ***
    // show all active goals at the organisation

    // middleware guarantees that
    // org admin is authenticated
    // and verified and active
    // is an org admin
    // and that they belong to the organisation
    // the organisation is active
    public function index($org_id) {

        // get organisation and relationships
        $organisation = Organisation::with([
            'homes' => function($query){
                return $query->orderBy('home_name');
            },
            'homes.clients',
            'homes.clients.user',
            'homes.clients.goals' => function($query){
                return $query->where('goal_status', GoalStatus::Active);
            },
            'homes.clients.goals.activityTypes'

        ])
        ->findOrFail($org_id);

        // flatMap homes, then goals
        $goals = $organisation->homes
            ->flatMap(fn($home) => $home->clients)
            ->flatMap(fn($client) => $client->goals);

        $goalsSorted = $goals->sortBy('title');

        // return the view
        return view('organisation-admin.goals')
            ->with('organisation', $organisation)
            ->with('goals', $goalsSorted);
    }
}
