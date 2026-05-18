<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ManagerViewClientController extends Controller
{
    public function index($org_id, $home_id, $client_id) {

        // load client and eagerly load their goals on client
        $client = Client::with(['goals', 'goals.activityTypes', 'goals.leadBy'])->findOrFail($client_id);


        return view('manager.client')
            ->with('client', $client)
            ->with('org_id', $org_id)
            ->with('home_id', $home_id);    
    }
}
