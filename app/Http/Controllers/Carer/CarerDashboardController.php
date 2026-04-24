<?php

namespace App\Http\Controllers\Carer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Carer;

class CarerDashboardController extends Controller
{
    public function index() {

        $carer = Auth::user()->carer;

        return view('carer.dashboard')
        ->with('homes', $carer->homes);

    }
}
