<?php

namespace App\Http\Controllers\OrganisationReporter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // *** index ***
    public function index() {
        // add data when ready

        return view('organisation-reporter.dashboard');
    }
}
