<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyFriend\FamilyFriendDashboardController;

// unscoped - landing page
Route::middleware(['auth', 'family-friend.access'])
    ->prefix('family-friend')
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

// org scoped - client specific routes
Route::middleware(['auth', 'family-friend.access'])
    ->prefix('organisations/{org_id}/family-friend')
    ->name('family-friend.')
    ->group(function(){
        // future client scoped routes will go here
        // e.g. Route::get('clients/{client_id}/goals', ...)->name('client.goals');
    });