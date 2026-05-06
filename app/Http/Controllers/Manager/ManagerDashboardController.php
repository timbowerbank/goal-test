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
        $organisation = Organisation::findOrFail($org_id);

        return view('manager.dashboard')
        ->with('homes', $manager->homes)
        ->with('is_manager', true)
        ->with('org_id', $org_id)
        ->with('organisation', $organisation);
    }
}
