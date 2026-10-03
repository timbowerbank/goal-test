<?php

namespace App\Http\Controllers\OrganisationReporter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Organisation;
use App\Models\Goal;
use App\Models\Region;
use App\Models\Home;
use App\Models\Manager;
use App\Models\Client;
use App\Models\Carer;
use App\Enums\ManagerStatus;
use App\Enums\OrganisationStatus;
use App\Enums\GoalStatus;
use App\Enums\ClientStatus;
use App\Enums\HomeStatus;
use App\Enums\CarerStatus;

class DashboardController extends Controller
{
    // *** index ***
    public function index($org_id) {

        // get the organisation
        $organisation = Organisation::where('organisation_status', OrganisationStatus::Active)
                            ->findOrFail($org_id);
        
        // authorize the user to view the organisation
        $this->authorize('view', $organisation);

        // get the regions
        $regions = Region::where('organisation_id', $org_id)->get();

        // get the goals for the organisation
        $goals = Goal::whereIn('goal_status', [GoalStatus::Draft, GoalStatus::Active])
                        ->whereHas('client', function($query) use($org_id){
                            return $query   ->where('clients.client_status', ClientStatus::Active)
                                            ->whereHas('home', function($q2) use($org_id){
                                                return $q2  ->where('homes.home_status', HomeStatus::Active)
                                                            ->whereHas('organisations', function($q3) use($org_id){
                                                                return $q3->where('organisations.id', $org_id);
                                                            });
                                            } );
                        })
                        ->get();

        // get the number of homes
        $homeCount = Home::where('home_status', HomeStatus::Active)
                            ->whereHas('organisations', function($query) use($org_id){
                                return $query->where('organisations.id', $org_id);
                            })
                            ->count();

        // manager count
        $managerCount = Manager::where('manager_status', ManagerStatus::Active)
                            ->whereHas('homes', function($query) use($org_id){
                                return $query   ->where('homes.home_status', HomeStatus::Active)
                                                ->whereHas('organisations', function($q2) use ($org_id){
                                                    return $q2->where('organisations.id', $org_id);
                                                });
                            })
                            ->count();

        // client count
        $clientCount = Client::where('client_status', ClientStatus::Active)
                            ->whereHas('home', function($query) use ($org_id){
                                return $query   ->where('homes.home_status', HomeStatus::Active)
                                                ->whereHas('organisations', function($q2) use ($org_id){
                                                    return $q2->where('organisations.id', $org_id);
                                                });
                            })
                            ->count();
        

        // carer count
        $carerCount = Carer::where('carer_status', CarerStatus::Active)
                        ->whereHas('homes', function($query) use ($org_id){
                            return $query   ->where('homes.home_status', HomeStatus::Active)
                                            ->whereHas('organisations', function($q2) use ($org_id){
                                                return $q2->where('organisations.id', $org_id);
                                            });
                        })
                        ->count();


        return view('organisation-reporter.dashboard')
            ->with('organisation', $organisation)
            ->with('goals', $goals)
            ->with('regions', $regions)
            ->with('homeCount', $homeCount)
            ->with('managerCount', $managerCount)
            ->with('clientCount', $clientCount)
            ->with('carerCount', $carerCount);
    }
}
