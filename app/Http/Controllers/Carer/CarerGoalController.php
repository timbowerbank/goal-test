<?php

namespace App\Http\Controllers\Carer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;

// middleware guarantees
// carer is authenticated, verified and active
// carer belongs to the organisation
class CarerGoalController extends Controller
{
    
    // *** show() ***
    public function show($org_id, $home_id, $client_id, $goal_id) {

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
            ->forClient($client_id)
            ->findOrFail($goal_id);

        // check that carer is authorized to view
        $this->authorize('read', $goal);

        return view('carer.goal')
            ->with('org_id', $org_id)
            ->with('home_id', $home_id)
            ->with('goal', $goal);
    }


}
