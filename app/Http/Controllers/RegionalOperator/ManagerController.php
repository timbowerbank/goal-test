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

        // get the managers
        $managers = Manager::where('manager_status', ManagerStatus::Active)
                    ->whereHas('homes', function($q) use ($region_id){
                        return $q   ->where('homes.region_id', $region_id)
                                    ->where('homes.home_status', HomeStatus::Active);
                    })->get();

        // load user on managers
        $managers->load([
            'user'
        ]);

        return view('regional-operator.managers')
                    ->with('region', $region)
                    ->with('managers', $managers)
                    ->with('org_id', $org_id);
    }
}
