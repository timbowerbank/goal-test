<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Enums\CarerStatus;


class CarerController extends Controller
{
    // *** index() ***
    // see all carers who work at the organisation

    // middleware guarantees that
    // org admin is authenticated
    // and verified and active
    // is an org admin
    // and that they belong to the organisation
    // the organisation is active
    public function index($org_id) {

        // get the organisation
        $organisation = Organisation::with([
            'homes' => function($query){
                return $query->orderBy('home_name');
            },
            'homes.carers' => function($query){
                return $query->join('users', 'carers.user_id', 'users.id')
                        ->where('carer_status', CarerStatus::Active)
                        ->orderBy('users.surname')
                        ->select('carers.*');
            },
            'homes.carers.user',

        ])
            ->findOrFail($org_id);

        // get a flatmap which is unique carers
        $carers = $organisation->homes
            ->flatMap(fn($home) => $home->carers)
            ->unique('id')
            ->sortBy(fn($carer) => $carer->user->surname);


        return view('organisation-admin.carers')
            ->with('organisation', $organisation)
            ->with('carers', $carers);

    }
}
