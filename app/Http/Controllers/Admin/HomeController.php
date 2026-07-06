<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Models\Home;
use App\Enums\HomeStatus;
use App\Enums\ClientStatus;
use App\Enums\GoalStatus;
use App\Enums\ManagerStatus;
use App\Enums\CarerStatus;

class HomeController extends Controller
{

    // *** index() ***
    // get all homes for the organisation that are active

    // middleware guarantees that
    // org admin is authenticated
    // and verified and active
    // is an org admin
    // and that they belong to the organisation
    // the organisation is active
    public function index($org_id) {

        // get organisation with homes
        $organisation = Organisation::with([
            'homes' => function($query){
                return $query->where('home_status', HomeStatus::Active);
            }
        ])
        ->findOrFail($org_id);

        // sort homes
        $homesSorted = $organisation->homes->sortBy('home_name');

        return view('organisation-admin.homes')
            ->with('organisation', $organisation)
            ->with('homes', $homesSorted);
    }


    // *** show() ***
    // show one home
    // middleware guarantees that
    // org admin is authenticated
    // and verified and active
    // is an org admin
    // and that they belong to the organisation
    // the organisation is active

    // scope ensures that home belongs to organisation

    // policy ensures that home is active
    public function show($org_id, $home_id){

        // get home and check to see if it belongs to organisation
        $home = Home::currentlyBelongsToOrganisation($org_id)->findOrFail($home_id);
        // policy - check if home is active
        $this->authorize('view', $home);

        $home->load([
            'clients' => function($query){
                return $query->join('users', 'clients.user_id', '=', 'users.id')
                        ->where('client_status', ClientStatus::Active)
                        ->orderBy('users.surname')
                        ->select('clients.*');
            },
            'clients.user',
            'managers' => function($query){
                return $query->join('users', 'managers.user_id', '=', 'users.id')
                        ->where('manager_status', ManagerStatus::Active)
                        ->orderBy('users.surname')
                        ->select('managers.*');
            },
            'managers.user',
            'carers' => function($query){
                return $query->join('users', 'carers.user_id', '=', 'users.id')
                        ->where('carer_status', CarerStatus::Active)
                        ->orderBy('users.surname')
                        ->select('carers.*');
            },
            'carers.user',
            'clients.goals' => function($query){
                return $query->where('goal_status', GoalStatus::Active);
            },
            'createdBy'
        ]);
        

        // goals - flatmap
        $goals = $home->clients->flatMap(fn($client) => $client->goals);


        return view('organisation-admin.home')
            ->with('home', $home)
            ->with('goals', $goals);
    }
}
