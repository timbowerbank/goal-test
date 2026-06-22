<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home;

class ManagerViewCarersController extends Controller
{
    // middleware guarantees that
    // manager is authenticated
    // belongs to the organisation
    // is validated and active

    // scopes check that home belongs to organisation
    // withActiveCarers only loads active carers at that home

    // policy checks whether manager belongs to home
    // and the home is active
    public function index($org_id, $home_id) {
        $home = Home::currentlyBelongsToOrganisation($org_id)
            ->withActiveCarers()
            ->findOrFail($home_id);

        // authorize the manager to view the carers
        $this->authorize('read', $home);

        return view('manager.carers')
            ->with('home', $home)
            ->with('org_id', $org_id);
    }
}
