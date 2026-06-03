<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Client;

class ManagerViewHomeController extends Controller
{
    public function index($org_id, $home_id){
        // eager load clients and carers with home and validate that it belongs to an organisation
        $home = Home::with(
            [
                'clients', 
                'carers'])->currentlyBelongsToOrganisation($org_id)->findOrFail($home_id);

        return view('manager.home')
            ->with('home', $home)
            ->with('org_id', $org_id);
    }
}
