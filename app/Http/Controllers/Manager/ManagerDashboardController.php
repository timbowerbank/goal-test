<?php

namespace App\Http\Controllers\Manager;

use App\Models\Manager;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerDashboardController extends Controller
{
    
    // *** index() ***
    public function index() {

        $manager = Auth::user()->manager;

        return view('manager.dashboard')
        ->with('homes', $manager->homes)
        ->with('is_manager', true);
    }
}
