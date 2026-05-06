<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ManagerViewClientController extends Controller
{
    public function index($org_id, $home_id, $client_id) {
        $client = Client::findOrFail($client_id);

        return view('manager.client')
            ->with('client', $client)
            ->with('org_id', $org_id);    
    }
}
