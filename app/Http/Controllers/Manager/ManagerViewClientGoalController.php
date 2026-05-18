<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;

class ManagerViewClientGoalController extends Controller
{
    public function index($org_id, $home_id, $client_id, $goal_id) {
        $goal = Goal::findOrFail($goal_id);

        $goal = Goal::with(['client.user', 'createdBy'])->findOrFail($goal_id);


        return view('manager.goal')
            ->with('goal', $goal);
    }
}
