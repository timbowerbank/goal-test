<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Carer\CarerDashboardController;

Route::middleware(['auth', 'carer.org.access'])
    ->prefix('organisations/{org_id}/carer')
    ->name('carer.')->group(function(){
        
        Route::get('inactive', function(){
            return view('carer.inactive');
        });

        Route::get('pending-verification', function(){
            return view('carer.pending-verification');
        });

        Route::get('/dashboard', [CarerDashboardController::class, 'index'])->name('dashboard');
    });