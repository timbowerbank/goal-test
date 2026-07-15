<?php

namespace App\Http\Controllers\RegionalOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Carer;
use App\Models\Client;
use App\Models\Home;
use App\Models\Goal;
use App\Models\Manager;
use App\Models\Region;

use App\Enums\CarerStatus;
use App\Enums\ManagerStatus;
use App\Enums\ClientStatus;
use App\Enums\GoalStatus;
use App\Enums\HomeStatus;

class RegionController extends Controller
{
    // *** show() ***
    // Show regional data

    // middleware guarantees that user
    // is authenticated
    // is verified and active
    // belongs to the active organisation

    // scope ensures that
    // region belongs to the organisation

    // policy ensures that the user
    // is a member of this region
    public function show($org_id, $region_id) {

        $region = Region::regionBelongsToOrganisation($org_id)
            ->findOrFail($region_id);

        // policy authorise the user
        $this->authorize('view', $region);



        $homeCount = Home::where('home_status', HomeStatus::Active)
                        ->where('region_id', $region_id)
                        ->count();

        
        $managerCount = Manager::where('manager_status', ManagerStatus::Active)
                                    ->whereHas('homes', function($q) use ($region_id) {
                                        return $q   ->where('home_status', HomeStatus::Active)
                                                    ->where('region_id', $region_id);
                                    })
                                    ->count();


        $clientCount = Client::where('client_status', ClientStatus::Active)
                            ->whereHas('home', function($q) use ($region_id){
                                return $q   ->where('homes.home_status', HomeStatus::Active)
                                            ->where('homes.region_id', $region_id);
                            })
                            ->count();


        $carerCount = Carer::where('carer_status', CarerStatus::Active)
                            ->whereHas('homes', function($q) use ($region_id){
                                return $q   ->where('homes.home_status', HomeStatus::Active)
                                            ->where('homes.region_id', $region_id);
                            })
                            ->count();




        $goals = Goal::where('goal_status', GoalStatus::Active)
                    ->whereHas('client', function($q) use ($region_id){
                        return $q   ->where('client_status', ClientStatus::Active)
                                    ->whereHas('home', function($q2) use($region_id){
                                        return $q2  ->where('homes.home_status', HomeStatus::Active)
                                                    ->where('homes.region_id', $region_id);
                                    });
                    })
                    ->get();

        

        return view('regional-operator.region')
            ->with('org_id', $org_id)
            ->with('region', $region)
            ->with('homeCount', $homeCount)
            ->with('managerCount', $managerCount)
            ->with('carerCount', $carerCount)
            ->with('clientCount', $clientCount)
            ->with('regionGoals', $goals);
    }
}
