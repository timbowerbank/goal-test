<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Home;
use App\Models\Client;

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
                'tasks',
                'tasks.assignedTo',
                'notes',
                'notes.createdBy'
            ])->forClient($client->user_id)->findOrFail($goal_id);


        return view('manager.goal')
            ->with('goal', $goal);
    }
}
