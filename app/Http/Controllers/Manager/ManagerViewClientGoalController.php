<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerViewClientGoalController extends Controller
{
    public function index($org_id, $home_id, $client_id, $goal_id) {
        return view('manager.goal');
    }
}
