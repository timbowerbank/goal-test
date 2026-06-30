<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Organisation;
use App\Models\Manager;
use App\Models\Client;
use App\Models\Goal;
use App\Models\Carer;

use App\Enums\ManagerStatus;
use App\Enums\ClientStatus;
use App\Enums\GoalStatus;
use App\Enums\CarerStatus;

class DashboardController extends Controller
{
    // dashboard for the Organisation Administrator
    public function index($org_id) {

        $organisation = Organisation::findOrFail($org_id);

        // managers
        $activeManagerCount = Manager::whereHas('homes.organisations', function($query) use($organisation){
            return $query->where('organisations.id', $organisation->id);
        })
        ->where('manager_status', ManagerStatus::Active)
        ->distinct()->count();

        // clients
        $activeClientCount = Client::whereHas('home.organisations', function($query) use($organisation){
            return $query->where('organisations.id', $organisation->id);
        })->where('client_status', ClientStatus::Active)->count();

        // goals
        $activeGoalCount = Goal::whereHas('client.home.organisations', function($query) use($organisation){
            return $query->where('organisations.id', $organisation->id);
        })->where('goal_status', GoalStatus::Active)->count();


        // Carers
        $activeCarerCount = Carer::whereHas('homes.organisations', function($query) use ($organisation){
            return $query->where('organisations.id', $organisation->id);
        })->where('carer_status', CarerStatus::Active)->distinct()->count();


        return view('organisation-admin.dashboard')
            ->with('managerCount', $activeManagerCount)
            ->with('clientCount', $activeClientCount)
            ->with('goalCount', $activeGoalCount)
            ->with('carerCount', $activeCarerCount);
    }
}
