<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Enums\HomeStatus;

class HomeController extends Controller
{

    // *** index() ***
    // get all homes for the organisation that are active

    // middleware guarantees that
    // org admin is authenticated
    // and verified and active
    // is an org admin
    // and that they belong to the organisation
    // the organisation is active
    public function index($org_id) {

        // get organisation with homes
        $organisation = Organisation::with([
            'homes' => function($query){
                return $query->where('home_status', HomeStatus::Active);
            }
        ])
        ->findOrFail($org_id);

        // sort homes
        $homesSorted = $organisation->homes->sortBy('home_name');

        return view('organisation-admin.homes')
            ->with('organisation', $organisation)
            ->with('homes', $homesSorted);
    }
}
