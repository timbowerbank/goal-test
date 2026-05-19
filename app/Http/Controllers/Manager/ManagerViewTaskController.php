<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerViewTaskController extends Controller
{
    public function index($org_id, $home_id, $carer_id, $task_id) {
        return view('manager.task');
    }
}
