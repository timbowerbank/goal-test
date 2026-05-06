<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Home;

class ManagerViewClientsController extends Controller
{
    public function index($org_id, $home_id) {
        $clients = Client::where('home_id', $home_id)->get();
        $home = Home::findOrFail($home_id);

        return view('manager.clients')
            ->with('clients', $clients)
            ->with('home', $home)
            ->with('org_id', $org_id);
    }
}
