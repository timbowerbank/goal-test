<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Client;

class ManagerViewHomeController extends Controller
{
    public function index($org_id, $home_id){
        // eager load clients and carers with home
        $home = Home::with(['clients', 'carers'])->findOrFail($home_id);

        return view('manager.home')
            ->with('home', $home);
    }
}
