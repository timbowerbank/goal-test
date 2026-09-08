<?php

namespace App\Http\Controllers\RegionalOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Client;

use App\Enums\ClientStatus;
use App\Enums\HomeStatus;

class ClientController extends Controller
{
    // *** index() ***
    // show all clients for a region
    // middleware guarantees that
    // user is authenticated
    // user is verified and active
    // user belongs to the organisation

    // scopes ensure that 
    // region belongs to the organisation

    // policy ensures that regional operator is
    // verified, active and belongs to the region
    public function index($org_id, $region_id) {

        // validate that the region belongs to the organisation
        $region = Region::regionBelongsToOrganisation($org_id)->findOrFail($region_id);

        // authorise the user to view the region
        $this->authorize('view', $region);

        // get all the clients
        $clients = Client::join('users', 'clients.user_id', 'users.id')
                        ->where('clients.client_status', ClientStatus::Active)
                        ->whereHas('home', function($query) use($region_id){
                            return $query->where('homes.region_id', $region_id)
                                        ->where('homes.home_status', HomeStatus::Active);
                        })
                        ->orderBy('users.surname')
                        ->select('clients.*')
                        ->with([
                            'user'
                        ])
                        ->get();



        return view('regional-operator.clients')
                ->with('org_id', $org_id)
                ->with('region', $region)
                ->with('clients', $clients);

    }
}
