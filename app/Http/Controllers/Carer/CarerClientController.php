<?php

namespace App\Http\Controllers\Carer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Enums\GoalStatus;


// middleware guarantees
// carer is authenticated, verified and active
// carer belongs to the organisation
class CarerClientController extends Controller
{
    public function show($org_id, $home_id, $client_id) {

        // get the user which is a carer
        $user = Auth::user();

        // eager load client with user, goals, tasks and home
        $client = Client::with(
            [
                'user',
                'goals' => function($query){
                    $query->where('goal_status', GoalStatus::Active);
                },
                'goals.tasks' => function($query) use ($user) {
                    $query->where('assigned_to_user_id', $user->id);
                },
                'home'
            ]
        )
            ->confirmClientBelongsToHome($home_id)
            ->findOrFail($client_id);

        // flatten the tasks into a variable
        $tasks = $client->goals->flatMap(fn($goal) => $goal->tasks);

        // check policy to authorise carer to view client
        $this->authorize('read', $client);

        return view('carer.client')
            ->with('client', $client)
            ->with('tasks', $tasks)
            ->with('org_id', $org_id)
            ->with('home_id', $home_id);
    }
}
