<?php

namespace App\Http\Controllers\Manager;

use App\Models\Manager;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ManagerDashboardController extends Controller
{
    
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
                'homes.clients',
                'homes.carers'
            ]
        );

        $organisation = Organisation::findOrFail($org_id);

        return view('manager.dashboard')
            ->with('homes', $manager->homes)
            ->with('org_id', $org_id)
            ->with('organisation', $organisation)
            ->with('manager', $manager);
    }
}
