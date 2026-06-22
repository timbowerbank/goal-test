<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Home;
use App\Models\Client;

// middleware guarantees that
// manager is authenticated
// belongs to the organisation
// is validated and active

// scopes ensure that
// home belongs to the organisation
// client belongs to the home
// goal belongs to the client

// policies ensure that
// goal belongs to same home as manager
// home is active
// goal is active or draft
// client is active

class ManagerViewClientGoalController extends Controller
{
    public function index($org_id, $home_id, $client_id, $goal_id) {
        // Validate that home belongs to organisation
        $home = Home::currentlyBelongsToOrganisation($org_id)->findOrFail($home_id);

        // Validate that client belongs to the home
        $client = Client::confirmClientBelongsToHome($home_id)->findOrFail($client_id); 

        // Validate that goal belongs to client
        $goal = Goal::with(
            [
                'client.user', 
                'createdBy',
                'home',
                'tasks',
                'tasks.assignedTo',
                'notes',
                'notes.createdBy'
            ])->forClient($client->user_id)->findOrFail($goal_id);
        
        // authorize home is active, manager belongs to home, 
        // goal is active or draft
        // client is active
        // client belongs to home
        $this->authorize('view', [$goal, $goal->home->id]);


        return view('manager.goal')
            ->with('goal', $goal)
            ->with('org_id', $org_id)
            ->with('home_id', $home_id);
    }
}
