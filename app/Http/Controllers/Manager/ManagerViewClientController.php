<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Home;

class ManagerViewClientController extends Controller
{
    // middleware guarantees that
    // manager is authenticated, verified and active
    // and belong to the organisation
    
    // scopes ensure that home belongs to organisation
    // client belongs to home
    
    // HOME policy
    // policy ensures that home is active
    // policy ensures that manager belongs to home

    // CLIENT policy
    // policy ensures that client and manager belong to the same home
    // policy ensure that client is active
    public function index($org_id, $home_id, $client_id) {

        // validate whether the home belongs to the organisation
        $home = Home::currentlyBelongsToOrganisation($org_id)
            ->findOrFail($home_id);

        // load client and eagerly load their goals on client
        $client = Client::with(
            [
                'goals', 
                'goals.activityTypes', 
                'goals.leadBy'
            ])
            ->confirmClientBelongsToHome($home_id)
            ->findOrFail($client_id);

        // only authorize if home is active
        $this->authorize('read', $home);            
        // authorize if client belongs to same home and client is active
        $this->authorize('read', $client);
        


        return view('manager.client')
            ->with('client', $client)
            ->with('org_id', $org_id)
            ->with('home_id', $home_id);    
    }
}
