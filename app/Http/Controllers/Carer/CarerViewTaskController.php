<?php

namespace App\Http\Controllers\Carer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carer;
use App\Models\Home;
use Illuminate\Support\Facades\Auth;

class CarerViewTaskController extends Controller
{
    public function index($org_id, $home_id) {

        // withActiveTasksForHome comes with:
        // tasks, 
        // tasks.goal
        // tasks.goal.client.user
        // tasks.goal.home
        $carer = Carer::carerBelongsToHome($home_id)
                        ->withActiveTasksForHome($home_id)
                        ->findOrFail(Auth::user()->carer->id);

        $home = Home::currentlyBelongsToOrganisation($org_id)
                    ->findOrFail($home_id);

        return view('carer.tasks')
                ->with('carer', $carer)
                ->with('org_id', $org_id)
                ->with('home', $home);
    }
}
