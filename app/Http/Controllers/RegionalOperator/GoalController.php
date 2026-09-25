<?php

namespace App\Http\Controllers\RegionalOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Region;
use App\Models\Goal;

use App\Enums\ClientStatus;
use App\Enums\HomeStatus;
use App\Enums\GoalStatus;

class GoalController extends Controller
{
    // *** show() ***
    // display a goal for a client

    // middleware guarantees that
    // user is authenticated
    // user is active and verified
    // user belongs to organisation
    // organisation is active

    // region policy ensures that regional operator can view this region
    // goal policy ensures that user belongs to same region as the goal
    // and that user is active and verified
    // scopes ensure that goal is active or draft
    // and that home belongs to region and is active
    public function show($org_id, $region_id, $client_id, $goal_id) {

        // check that region belongs to organisation and is a valid region
        $region = Region::regionBelongsToOrganisation($org_id)->findOrFail($region_id);

        // authorise the user for the region
        $this->authorize('view', $region);

        // get the goal
        $goal = Goal::whereIn('goal_status', [GoalStatus::Draft, GoalStatus::Active])
                        ->whereHas('client', function($query) use($region_id){
                            return $query   ->where('client_status', ClientStatus::Active)
                                            ->whereHas('home', function($q2) use($region_id){
                                                return $q2  ->where('homes.home_status', HomeStatus::Active)
                                                            ->where('homes.region_id', $region_id);
                                            });
                        })
                        ->with([
                            'client.user',
                            'client.home',
                            'notes'

                        ])
                        ->findOrFail($goal_id);

        // authorise the user to view this goal
        $this->authorize('view', [$goal, $goal->client->home->id]);


        return view('regional-operator.goal')
            ->with('org_id', $org_id)
            ->with('region_id', $region_id)
            ->with('goal', $goal);
    }
}
