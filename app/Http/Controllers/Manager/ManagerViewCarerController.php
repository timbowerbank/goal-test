<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carer;

class ManagerViewCarerController extends Controller
{
    public function index($org_id, $home_id, $carer_id) {
        $carer = Carer::findOrFail($carer_id);

        return view('manager.carer')
            ->with('org_id', $org_id)
            ->with('home_id', $home_id)
            ->with('carer', $carer);
    }
}
