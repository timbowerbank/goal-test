<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Carer\CarerDashboardController;
use App\Http\Controllers\Carer\CarerHomeController;

Route::middleware(['auth', 'carer.org.access'])
    ->prefix('organisations/{org_id}/carer')
    ->name('carer.')->group(function(){
        
        Route::get('inactive', function(){
            return view('carer.inactive');
        })->name('inactive');

        Route::get('pending-verification', function(){
            return view('carer.pending-verification');
        })->name('pending-verification');

        Route::get('dashboard', [CarerDashboardController::class, 'index'])->name('dashboard');

        Route::get('homes/{home_id}', [CarerHomeController::class, 'index'])->name('home');

        Route::get('homes/{home_id}/tasks/', [CarerViewTaskController::class, 'index'])->name('view-tasks');
    });