<?php

namespace App\Http\Controllers\Manager;

use App\Models\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerDashboardController extends Controller
{
    
    // *** index() ***
    public function index() {
        return view('manager.dashboard')
        ->with('homes', Manager::homes());
    }
}
