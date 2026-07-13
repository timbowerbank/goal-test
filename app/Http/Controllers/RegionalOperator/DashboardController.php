<?php

namespace App\Http\Controllers\RegionalOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegionalOperator;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // *** index() ***
    // middleware guarantees that
    // user is authenticated
    // user is verified and active
    // user belongs to the organisation

    // no policies or extra scopes required
    public function index($org_id) {

        // get the user
        $regionalOperator = RegionalOperator::with([
            'regions' => function($query){
                return $query->orderBy('name');
            },
            'user',
        ])->findOrFail(Auth::user()->regionalOperator->id);

        // get the organisation
        $organisation = Organisation::findOrFail($org_id);
        
        return view('regional-operator.dashboard')
            ->with('organisation', $organisation)
            ->with('regionalOperator', $regionalOperator);
    }
}
