<?php

namespace App\Http\Controllers\RegionalOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Manager;

use App\Enums\ManagerStatus;
use App\Enums\HomeStatus;

class ManagerController extends Controller
{
    // *** index() ***
    // show all managers for a region
    // middleware guarantees that
    // user is authenticated
    // user is verified and active
    // user belongs to the organisation

    // scopes ensure that 
    // region belongs to the organisation

    // policy ensures that regional operator is
    // verified, active and belongs to the region
    public function index($org_id, $region_id) {

        // get the region to validate organisation
        $region = Region::regionBelongsToOrganisation($org_id)
                    ->findOrFail($region_id);

        // authorise the user to view the region
        $this->authorize('view', $region);

        // get the managers and eager load the user
        $managers = Manager::join('users', 'managers.user_id', 'users.id')        
                    ->where('manager_status', ManagerStatus::Active)
                    ->whereHas('homes', function($q) use ($region_id){
                        return $q   ->where('homes.region_id', $region_id)
                                    ->where('homes.home_status', HomeStatus::Active);
                    })
                    ->orderBy('users.surname')
                    ->select('managers.*')
                    ->with(['user'])
                    ->get();


        return view('regional-operator.managers')
                    ->with('region', $region)
                    ->with('managers', $managers)
                    ->with('org_id', $org_id);
    }


    // *** show() ***
    // show the manager
    // middleware guarantees that
    // user is authenticated
    // user is verified and active
    // user belongs to the organisation

    // scopes ensure that 
    // region belongs to the organisation
    // manager belongs to organisation

    // policy ensures that regional operator is
    // verified, active and belongs to the region
    public function show($org_id, $region_id, $manager_id) {

        // check that region belongs to organisation
        $region = Region::regionBelongsToOrganisation($org_id)->findOrFail($region_id);

        // authorize the user
        $this->authorize('view', $region);

        // get the manager, eager load homes
        $manager = Manager::currentlyBelongsToOrganisation($org_id)
                    ->where('manager_status', ManagerStatus::Active)
                    ->whereHas('homes', function($query) use($region_id){
                        return $query->where('homes.home_status', HomeStatus::Active)
                                    ->where('homes.region_id', $region_id);
                    })
                    ->with([
                        'homes' => function($query) use ($region_id) {
                            return $query->where('homes.home_status', HomeStatus::Active)
                                        ->where('homes.region_id', $region_id)
                                        ->orderBy('homes.home_name');
                        },
                        'user',                        
                    ])
                    ->findOrFail($manager_id);

        return view('regional-operator.manager')
            ->with('org_id', $org_id)
            ->with('region', $region)
            ->with('manager', $manager);
    }
}
