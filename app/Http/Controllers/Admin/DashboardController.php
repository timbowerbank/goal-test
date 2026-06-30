<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Organisation;
use App\Models\Manager;
use App\Models\Client;
use App\Models\Goal;
use App\Models\Carer;
use App\Models\Home;

use App\Enums\ManagerStatus;
use App\Enums\ClientStatus;
use App\Enums\GoalStatus;
use App\Enums\CarerStatus;
use App\Enums\HomeStatus;

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
        $activeGoals = Goal::whereHas('client.home.organisations', function($query) use($organisation){
            return $query->where('organisations.id', $organisation->id);
        })->where('goal_status', GoalStatus::Active)->get();


        // Carers
        $activeCarerCount = Carer::whereHas('homes.organisations', function($query) use ($organisation){
            return $query->where('organisations.id', $organisation->id);
        })->where('carer_status', CarerStatus::Active)->distinct()->count();

        // Homes
        $activeHomesCount = Home::whereHas('organisations', function($query) use ($organisation){
            return $query->where('organisations.id', $organisation->id);
        })->count();


        return view('organisation-admin.dashboard')
            ->with('organisation', $organisation)
            ->with('homeCount', $activeHomesCount)
            ->with('managerCount', $activeManagerCount)
            ->with('clientCount', $activeClientCount)
            ->with('goals', $activeGoals)
            ->with('carerCount', $activeCarerCount);
    }
}
