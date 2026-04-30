<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyFriend\FamilyFriendDashboardController;

Route::middleware(['auth'])
    ->prefix('organisations/{org_id}/family-friend')
    ->name('family-friend.')
    ->group(function(){
        Route::get('inactive', function(){
            return view('family-friend.inactive');
        })->name('inactive');

        Route::get('pending-verification', function(){
            return view('family-friend.pending-verification');
        })->name('pending-verification');

        Route::get('dashboard', [FamilyFriendDashboardController::class, 'index'])->name('dashboard');
    });