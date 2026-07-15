<?php

namespace App\Http\Controllers\RegionalOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Enums\HomeStatus;

class HomeController extends Controller
{
    // *** index() ***
    // display all homes for a region

    // middleware guarantees that
    // user is authenticated
    // user is active and verified
    // user belongs to organisation
    // organisation is active

    // scopes ensure that
    // region belongs to organisation

    // policy ensures that
    // RO belongs to region
    // is active and verified
    public function index($org_id, $region_id){

        $region = Region::with([
            'homes' => function($query){
                return $query   ->where('home_status', HomeStatus::Active)
                                ->orderBy('home_name');
            }
        ])
        ->regionBelongsToOrganisation($org_id)
        ->findOrFail($region_id);

        // authorise the user to view this region
        $this->authorize('view', $region);

        return view('regional-operator.homes')
            ->with('org_id', $org_id)
            ->with('region', $region);
    }
}
