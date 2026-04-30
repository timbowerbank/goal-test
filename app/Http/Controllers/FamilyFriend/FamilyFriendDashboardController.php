<?php

namespace App\Http\Controllers\FamilyFriend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FamilyFriendDashboardController extends Controller
{
    public function index() {
        return view('family-friend.dashboard');

    }

    // new index to replace the above
    //  public function index() {
    //     $clients = Auth::user()->familyFriend->clients()
    //         ->wherePivotNull('ended_at')
    //         ->with('home.organisation')
    //         ->orderBy('users.surname')
    //         ->get();

    //     return view('family-friend.dashboard', compact('clients'));
    // }
}
