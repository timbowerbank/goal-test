<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientDashboardController;

Route::middleware(['auth'])
    ->prefix('organisations/{org_id}/client')
    ->name('client.')->group(function(){

        Route::get('pending-verification', function(){
            return view('client.pending-verification');
        });

        Route::get('inactive', function(){
            return view('client.inactive');
        })->name('inactive');

        Route::get('dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');

    });