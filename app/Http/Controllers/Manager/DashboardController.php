<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // middleware guarantees
    // manager is authenticated, verified and active
    // manager belongs to the organisation
    // The organisation is active
    // *** index() ***
    public function index($org_id) {

        $manager = Auth::user()->manager;

        $manager->load(
            [
                'homes' => function($query) use ($org_id){
                    $query->whereHas('organisation', function($q) use ($org_id){
                        $q  ->where('organisations.id', $org_id)
                            ->whereNull('home_organisation.ended_at');
                    });
                },
            ]
        );

        $organisation = Organisation::findOrFail($org_id);

        return view('manager.dashboard')
            ->with('homes', $manager->homes)
            ->with('org_id', $org_id)
            ->with('organisation', $organisation)
            ->with('user', Auth::user());
    }
}
