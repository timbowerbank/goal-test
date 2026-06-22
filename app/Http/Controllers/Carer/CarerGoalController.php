<?php

namespace App\Http\Controllers\Carer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Client;

// middleware guarantees
// carer is authenticated, verified and active
// carer belongs to the organisation
class CarerGoalController extends Controller
{
    
    // *** show() ***
    // middleware guarantees
    // carer is authenticated, verified and active
    // carer belongs to the organisation

    // Scopes guarantee:
    // client belongs to home
    // goal belongs to client

    // Policy checks
    // Goal must belong to same home as carer. 
    // Home must be active. 
    // Goal must be active or draft. 
    // Client must be active.
    public function show($org_id, $home_id, $client_id, $goal_id) {

        // Validate that client belongs to the home
        $client = Client::confirmClientBelongsToHome($home_id)->findOrFail($client_id); 

        // eagerly load data
        $goal = Goal::with(
            [
                'client.user',
                'createdBy',
                'tasks',
                'tasks.assignedTo',
                'notes',
                'notes.createdBy',
                'home',
            ]
        )
            ->forClient($client->user_id)
            ->findOrFail($goal_id);

        // check that carer is authorized to view
        $this->authorize('view', [$goal, $home_id]);

        return view('carer.goal')
            ->with('org_id', $org_id)
            ->with('home_id', $home_id)
            ->with('goal', $goal);
    }


}
