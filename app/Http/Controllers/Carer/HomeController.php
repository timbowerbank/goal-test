<?php

namespace App\Http\Controllers\Carer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Carer;
use App\Models\Home;

class HomeController extends Controller
{
    public function show($org_id, $home_id) {

        // get the home with clients, check home belongs to organisation
        $home = Home::currentlyBelongsToOrganisation($org_id)
            ->withActiveClients()
            ->findOrFail($home_id);

       
        $carer = Carer::withActiveTasksForHome($home_id)
                    ->carerBelongsToHome($home_id)
                    ->findOrFail(Auth::user()->carer->id);
        
        

        return view('carer.home')
            ->with('home', $home)
            ->with('carer', $carer)
            ->with('org_id', $org_id)
            ->with('home_id', $home_id);
    }
}
