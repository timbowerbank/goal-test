<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Home;

class ManagerViewClientsController extends Controller
{
    // middleware guarantees that
    // manager is authenticated
    // belongs to the organisation
    // is validated and active

    // scopes only provide active clients
    // checks whether home belongs to organisation
    
    // policy checks manager belongs to the home
    // and whether the Home is active
    public function index($org_id, $home_id) {
        $home = Home::withActiveClients()
            ->currentlyBelongsToOrganisation($org_id)
            ->findOrFail($home_id);

        // authorise the manager
        $this->authorize('view', $home);

        return view('manager.clients')
            ->with('home', $home)
            ->with('org_id', $org_id);
    }
}
