<?php

namespace App\Http\Controllers\RegionalOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // *** index() ***
    public function index($org_id) {
    // temp method


        return view('regional-operator.dashboard');
    }
}
