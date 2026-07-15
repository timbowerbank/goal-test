<?php

namespace App\Http\Controllers\RegionalOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Home;
use App\Enums\HomeStatus;
use App\Enums\ClientStatus;
use App\Enums\CarerStatus;
use App\Enums\ManagerStatus;

class HomeController extends Controller
{
    // *** index() ***
    // display all homes for a region

    // middleware guarantees that
    // user is authenticated
    // user is active and verified
    // user belongs to organisation
    // organisation is active

    // scopes ensure that
    // region belongs to organisation

    // policy ensures that
    // RO belongs to region
    // is active and verified
    public function index($org_id, $region_id){

        $region = Region::with([
            'homes' => function($query){
                return $query   ->where('home_status', HomeStatus::Active)
                                ->orderBy('home_name');
            }
        ])
        ->regionBelongsToOrganisation($org_id)
        ->findOrFail($region_id);

        // authorise the user to view this region
        $this->authorize('view', $region);

        return view('regional-operator.homes')
            ->with('org_id', $org_id)
            ->with('region', $region);
    }


    // *** show() ***
    // shows one home in a region

    // middleware guarantees that
    // user is authenticated
    // user is active and verified
    // user belongs to organisation
    // organisation is active

    // scope ensures that
    // region belongs to organisation
    // home belongs to region
    // home belongs to organisation

    // policy ensures that regional operator
    // belongs to region
    // is active and verified
    
    public function show($org_id, $region_id, $home_id) {

        // check region
        $region = Region::regionBelongsToOrganisation($org_id)
                    ->findOrFail($region_id);

        // authorise user to view region
        $this->authorize('view', $region);

        // get home
        $home = Home::currentlyBelongsToOrganisation($org_id)
                    ->currentlyBelongsToRegion($region_id)
                    ->findOrFail($home_id);

        // authorize user to view the home
        $this->authorize('view', [$home, $region_id]);
        
        // now user is approved load extra relationships
        $home->load([
            'clients' => function($query){
                return $query   ->join('users', 'clients.user_id', 'users.id')
                                ->where('clients.client_status', ClientStatus::Active)
                                ->orderBy('users.surname')
                                ->select('clients.*');
            },
            'clients.user',
            'clients.goals',
            'carers' => function($query){
                return $query   ->join('users', 'carers.user_id', 'users.id')
                                ->where('carers.carer_status', CarerStatus::Active)
                                ->orderBy('users.surname')
                                ->select('carers.*');
            },
            'carers.user',
            'managers' => function($query){
                return $query   ->join('users', 'managers.user_id', 'users.id')
                                ->where('managers.manager_status', ManagerStatus::Active)
                                ->orderBy('users.surname')
                                ->select('managers.*');
            },
            'managers.user',
        ]);

        // flatten goals
        $goals = $home->clients->flatMap(fn($client) => $client->goals);

        // manager count
        $managerCount = $home->managers->count();

        // carer count
        $carerCount = $home->carers->count();

        // client count
        $clientCount = $home->clients->count();


        return view('regional-operator.home')
            ->with('org_id', $org_id)
            ->with('region', $region)
            ->with('home', $home)
            ->with('goals', $goals)
            ->with('clientCount', $clientCount)
            ->with('carerCount', $carerCount)
            ->with('managerCount', $managerCount);
    }
}
