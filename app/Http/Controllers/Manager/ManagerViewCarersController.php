<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home;

class ManagerViewCarersController extends Controller
{
    public function index($org_id, $home_id) {
        $home = Home::with(['carers'])->findOrFail($home_id);

        return view('manager.carers')
            ->with('home', $home)
            ->with('org_id', $org_id);
    }
}
