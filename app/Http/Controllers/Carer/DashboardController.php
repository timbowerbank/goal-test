<?php

namespace App\Http\Controllers\Carer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Carer;
use App\Models\Organisation;


class DashboardController extends Controller
{
    public function index($org_id) {

        $carer = Auth::user()->carer;

        $carer->load(
            [
                'homes' => function($query) use ($org_id) {
                    $query->whereHas('organisation', function($q) use ($org_id){
                        $q  ->where('organisations.id', $org_id)
                            ->whereNull('home_organisation.ended_at');
                    });
                }
            ]);

        $organisation = Organisation::findOrFail($org_id);

        return view('carer.dashboard')
            ->with('carer', $carer)
            ->with('homes', $carer->homes)
            ->with('organisation', $organisation);

    }
}
