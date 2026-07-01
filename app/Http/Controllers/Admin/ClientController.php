<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Enums\ClientStatus;

class ClientController extends Controller
{
    // *** index() ***
    // list all clients across the organisation

    // middleware guarantees that
    // org admin is authenticated
    // and verified and active
    // is an org admin
    // and that they belong to the organisation
    // the organisation is active
    public function index($org_id) {

        // get organisation with clients and users
        $organisation = Organisation::with([
            'homes' => function($query){
                return $query->orderBy('home_name');
            },
            'homes.clients' => function($query){
                return $query
                    ->join('users', 'clients.user_id', '=', 'users.id')
                    ->where('client_status', ClientStatus::Active)
                    ->orderBy('users.surname')
                    ->select('clients.*');
            },
            'homes.clients.user',
        ])
            ->findOrFail($org_id);


        // flatmap clients for truthy
        $clients = $organisation->homes
            ->flatMap(fn($home) => $home->clients);


        return view('organisation-admin.clients')
            ->with('organisation', $organisation)
            ->with('clients', $clients);
    }
}
