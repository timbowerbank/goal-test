<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Home;

class ManagerViewClientController extends Controller
{
    public function index($org_id, $home_id, $client_id) {

        // validate whether the home belongs to the organisation
        $home = Home::currentlyBelongsToOrganisation($org_id)->findOrFail($home_id);

        // load client and eagerly load their goals on client
        $client = Client::with(
            [
                'goals', 
                'goals.activityTypes', 
                'goals.leadBy'
            ])->confirmClientBelongsToHome($home_id)->findOrFail($client_id);


        return view('manager.client')
            ->with('client', $client)
            ->with('org_id', $org_id)
            ->with('home_id', $home_id);    
    }
}
