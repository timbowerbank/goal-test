<?php

namespace App\Http\Controllers\Carer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Home;
use Illuminate\Support\Facades\Auth;
use App\Enums\GoalStatus;
use App\Enums\TaskStatus;
use App\Enums\ClientStatus;

class CarerClientController extends Controller
{

    // middleware guarantees
    // carer is authenticated, verified and active
    // carer belongs to the organisation

    // policy ensures that
    // carer must belong to the home
    // home must be active

    // scope checks whether home belongs to an organisation
    // filters ensure only active clients are listed
    public function index($org_id, $home_id) {
        
        // eagerly load home with clients
        $home = Home::with([
                'clients' => function($query) {
                    $query->where('client_status', ClientStatus::Active);
                },
                'clients.user'
            ])
                ->currentlyBelongsToOrganisation($org_id)
                ->findOrFail($home_id);
        
        // invoke authorize to ensure that user is allowed
        $this->authorize('read', $home);

        return view('carer.clients')
            ->with('home', $home)
            ->with('org_id', $org_id)
            ->with('home_id', $home_id);
    }


    // middleware guarantees
    // carer is authenticated, verified and active
    // carer belongs to the organisation
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
                    $query->where('assigned_to_user_id', $user->id)
                     ->whereIn('goal_task_status', [TaskStatus::NotStarted, TaskStatus::InProgress]);
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
