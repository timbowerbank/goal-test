<?php

namespace App\Http\Controllers\Carer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarerViewTaskController extends Controller
{
    public function index($org_id, $home_id) {
        return view('carer.tasks');
    }
}
