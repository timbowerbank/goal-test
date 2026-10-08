<?php

namespace App\Http\Controllers\OrganisationReporter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Goal;
use App\Models\Client;
use App\Models\Manager;
use App\Models\Carer;
use App\Models\Home;

use App\Enums\GoalStatus;
use App\Enums\HomeStatus;
use App\Enums\ManagerStatus;
use App\Enums\ClientStatus;
use App\Enums\CarerStatus;

class RegionController extends Controller
{
    
    // *** show() ***
    // show the region
    // middleware guarantees that
    // user is authenticated
    // user is verified and active
    // user belongs to the organisation

    // scopes ensure that 
    // region belongs to the organisation

    // policy ensures that region belongs to org
    // user is verified and active    
    public function show($org_id, $region_id) {

        // get the region
        $region = Region::regionBelongsToOrganisation($org_id)
                    ->findOrFail($region_id);

        // authorize viewing the region
        $this->authorize('view', $region);

        // get the goals for the region
        $goals = Goal::whereIn('goal_status', [GoalStatus::Draft, GoalStatus::Active])
                        ->whereHas('client', function($q1) use($region_id){
                            return $q1  ->where('clients.client_status', ClientStatus::Active)
                                        ->whereHas('home', function($q2) use($region_id){
                                            return $q2  ->where('homes.home_status', HomeStatus::Active)
                                                        ->where('homes.region_id', $region_id);
                                        });
                        })
                        ->get();

        // get homes count
        $homeCount = Home::where('home_status', HomeStatus::Active)
                            ->where('region_id', $region_id)
                            ->count();

        // get manager count
        $managerCount = Manager::where('manager_status', ManagerStatus::Active)
                                ->whereHas('homes', function($q1) use ($region_id){
                                    return $q1  ->where('homes.home_status', HomeStatus::Active)
                                                ->where('homes.region_id', $region_id);
                                })
                                ->count();


        // get client count
        $clientCount = Client::where('client_status', ClientStatus::Active)
                            ->whereHas('home', function($q1) use($region_id){
                                return $q1  ->where('homes.home_status', HomeStatus::Active)
                                            ->where('homes.region_id', $region_id);
                            })
                            ->count();

        // get the carer count
        $carerCount = Carer::where('carer_status', CarerStatus::Active)
                            ->whereHas('homes', function($q1) use($region_id){
                                return $q1  ->where('homes.home_status', HomeStatus::Active)
                                            ->where('homes.region_id', $region_id);
                            })
                            ->count();


        return view('organisation-reporter.region')
                ->with('org_id', $org_id)
                ->with('goals', $goals)
                ->with('homeCount', $homeCount)
                ->with('managerCount', $managerCount)
                ->with('clientCount', $clientCount)
                ->with('carerCount', $carerCount)
                ->with('region', $region);

    }



}
