<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home;

class ManagerViewHomeController extends Controller
{
    // middleware guarantees that
    // manager is authenticated, verified and active
    // manager belongs to organisation

    // Scopes ensure that only active clients and active carers are listed
    // Home model ensures that only clients at $home_id are listed
    // Policy ensures that manager belongs to home
    // Policy ensures that homes is active
    public function index($org_id, $home_id){

        // eager load clients and carers with home and validate that it belongs to an organisation - use scopes
        $home = Home::withActiveClients()
                    ->withActiveCarers()
                    ->currentlyBelongsToOrganisation($org_id)
                    ->activeHome()
                    ->findOrFail($home_id);

        // check that manager is authorised to view home
        $this->authorize('read', $home);

        return view('manager.home')
            ->with('home', $home)
            ->with('org_id', $org_id);
    }
}
