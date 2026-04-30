<?php

namespace App\Http\Controllers\FamilyFriend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FamilyFriendDashboardController extends Controller
{
    public function index() {
        return view('family-friend.dashboard');

    }
}
