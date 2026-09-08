<?php

namespace App\Http\Controllers\RegionalOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Carer;

use App\Enums\HomeStatus;
use App\Enums\CarerStatus;

class CarerController extends Controller
{
    
    // *** index() ***
    // show all carers for a region
    // middleware guarantees that
    // user is authenticated
    // user is verified and active
    // user belongs to the organisation

    // scopes ensure that 
    // region belongs to the organisation

    // policy ensures that regional operator is
    // verified, active and belongs to the region
    public function index($org_id, $region_id) {

        // verify that the region belongs to the organisation
        $region = Region::regionBelongsToOrganisation($org_id)->findOrFail($region_id);

        // authorise the user
        $this->authorize('view', $region);

        // get all carers
        $carers = Carer::join('users', 'carers.user_id', 'users.id')
                    ->where('carers.carer_status', CarerStatus::Active)
                    ->whereHas('homes', function($query) use ($region_id){
                        return $query->where('homes.home_status', HomeStatus::Active)
                                    ->where('homes.region_id', $region_id);
                    })
                    ->orderBy('users.surname')
                    ->select('carers.*')
                    ->with([
                        'user'
                    ])
                    ->get();


        return view('regional-operator.carers')
            ->with('org_id', $org_id)
            ->with('region', $region)
            ->with('carers', $carers);

    }
}
